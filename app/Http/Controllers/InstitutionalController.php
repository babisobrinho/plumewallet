<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Faq;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class InstitutionalController extends Controller
{
    /**
     * Página inicial (landing page)
     */
    public function index()
    {
        return view('institutional.index');
    }

    /**
     * Página Sobre Nós
     */
    public function aboutUs()
    {
        return view('institutional.about-us');
    }

    /**
     * Página Como Funciona
     */
    public function howItWorks()
    {
        return view('institutional.how-it-works');
    }

    /**
     * Página FAQ
     */
    public function faq()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('order')
            ->orderBy('created_at')
            ->get();

        return view('institutional.faq', compact('faqs'));
    }

    /**
     * Listagem do Blog
     */
    public function blog()
    {
        $posts = BlogPost::where('status', 'published')
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = BlogCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('institutional.blog.index', compact('posts', 'categories'));
    }

    /**
     * Visualização individual do post do blog
     */
    public function blogShow($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'author'])
            ->firstOrFail();

        // Incrementar contador de visualizações
        $post->increment('view_count');

        // Posts relacionados
        $relatedPosts = BlogPost::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                $query->where('category_id', $post->category_id)
                      ->orWhereIn('id', $post->tags ?? []);
            })
            ->with(['category', 'author'])
            ->limit(3)
            ->get();

        return view('institutional.blog.show', compact('post', 'relatedPosts'));
    }

    /**
     * Página de Contato
     */
    public function contact()
    {
        return view('institutional.contact');
    }

    /**
     * Processar formulário de contato
     */
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Salvar mensagem no banco de dados
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'new',
        ]);

        // Aqui você pode implementar o envio de email de notificação
        // Mail::to('admin@plumewallet.com')->send(new ContactMessageReceived($contactMessage));
        
        return redirect()->route('institutional.contact')
            ->with('success', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');
    }
}
