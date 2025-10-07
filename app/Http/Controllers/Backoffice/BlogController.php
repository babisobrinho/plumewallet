<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends BaseBackofficeController
{
    /**
     * Listar posts do blog
     */
    public function index(Request $request)
    {
        $query = BlogPost::with(['author', 'category']);

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $posts = $query->latest()->paginate(15);

        return view('backoffice.blog.posts.index', compact('posts'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        return view('backoffice.blog.posts.create');
    }

    /**
     * Criar novo post
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'category_id' => 'nullable|exists:blog_categories,id',
        ]);

        $post = BlogPost::create([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'author_id' => auth()->id(),
            'created_by' => auth()->id(),
        ]);

        return $this->redirectWithSuccess('backoffice.blog.posts.index', 'Post criado com sucesso');
    }

    /**
     * Exibir post específico
     */
    public function show(BlogPost $post)
    {
        $post->load(['author', 'category']);
        return view('backoffice.blog.posts.show', compact('post'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(BlogPost $post)
    {
        return view('backoffice.blog.posts.edit', compact('post'));
    }

    /**
     * Atualizar post
     */
    public function update(Request $request, BlogPost $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'category_id' => 'nullable|exists:blog_categories,id',
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title, $post->id),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'updated_by' => auth()->id(),
        ]);

        return $this->redirectWithSuccess('backoffice.blog.posts.index', 'Post atualizado com sucesso');
    }

    /**
     * Alternar destaque do post
     */
    public function toggleFeatured(BlogPost $post)
    {
        $post->update([
            'is_featured' => !$post->is_featured,
        ]);

        $message = $post->is_featured ? 'Post destacado com sucesso' : 'Destaque removido com sucesso';
        return $this->redirectWithSuccess('backoffice.blog.posts.index', $message);
    }

    /**
     * Excluir post
     */
    public function destroy(BlogPost $post)
    {
        $post->delete();
        return $this->redirectWithSuccess('backoffice.blog.posts.index', 'Post excluído com sucesso');
    }

    /**
     * Gerar slug único baseado no título
     */
    private function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (BlogPost::where('slug', $slug)
            ->when($excludeId, function ($query, $excludeId) {
                return $query->where('id', '!=', $excludeId);
            })
            ->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
