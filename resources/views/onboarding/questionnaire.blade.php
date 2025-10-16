<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-gray-800 dark:to-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto h-16 w-16 bg-gradient-to-br from-plume-blue-600 to-plume-teal-600 rounded-full flex items-center justify-center mb-4">
                    <i class="ti ti-file-text text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                    Vamos Personalizar a Sua Conta
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 dark:text-gray-400">
                    Responda a algumas perguntas para criarmos a configuração ideal para si
                </p>
            </div>

            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400 dark:text-gray-400 mb-2">
                    <span>Progresso</span>
                    <span id="progress-text">1 de 5</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div id="progress-bar" class="bg-plume-blue-600 h-2 rounded-full transition-all duration-300" style="width: 20%"></div>
                </div>
            </div>

            <!-- Questionnaire Form -->
            <form id="onboarding-form" class="space-y-8">
                @csrf
                
                <!-- Question 1: Organization Level -->
                <div class="question-card bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        1. Como descreveria a sua abordagem à organização financeira?
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 cursor-pointer transition-colors bg-gray-50 dark:bg-gray-700">
                            <input type="radio" name="organizacao" value="A" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Muito organizado</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 dark:text-gray-400">Gosto de categorias específicas e detalhadas</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 cursor-pointer transition-colors bg-gray-50 dark:bg-gray-700">
                            <input type="radio" name="organizacao" value="B" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Mais ou menos</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 dark:text-gray-400">Algumas categorias específicas, outras gerais</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 cursor-pointer transition-colors bg-gray-50 dark:bg-gray-700">
                            <input type="radio" name="organizacao" value="C" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Prefiro simplicidade</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 dark:text-gray-400">Categorias amplas e simples</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                    </div>
                </div>

                <!-- Question 2: Situation -->
                <div class="question-card bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-200 dark:border-gray-700 hidden">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        2. Qual descreve melhor a sua situação atual?
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="situacao" value="A" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Estudante</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Sem rendimentos ou com trabalho part-time</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="situacao" value="B" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Profissional empregado</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Salário fixo</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="situacao" value="C" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Profissional com negócio</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Tenho o meu próprio negócio</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="situacao" value="D" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Pessoa endividada</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Foco em pagar dívidas</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="situacao" value="E" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Família</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Gestão de despesas partilhadas</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                    </div>
                </div>

                <!-- Question 3: Objective -->
                <div class="question-card bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-200 dark:border-gray-700 hidden">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        3. Qual é o seu objetivo financeiro principal no momento?
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="objetivo" value="A" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Controlar gastos diários</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="objetivo" value="B" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Pagar dívidas</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="objetivo" value="C" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Poupar para um objetivo específico</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="objetivo" value="D" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Gerir negócio/empresa</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="objetivo" value="E" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Planeamento familiar</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                    </div>
                </div>

                <!-- Question 4: Income Sources -->
                <div class="question-card bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-200 dark:border-gray-700 hidden">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        4. Quantas fontes de rendimento tem?
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="rendimentos" value="A" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Nenhuma</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Estudante/dependente</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="rendimentos" value="B" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Uma fonte</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Salário/bolsa</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="rendimentos" value="C" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Duas ou mais fontes</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                    </div>
                </div>

                <!-- Question 5: Account Complexity -->
                <div class="question-card bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-200 dark:border-gray-700 hidden">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        5. Quantas contas/carteiras costuma usar?
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="contas" value="A" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Uma conta principal</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="contas" value="B" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">2-3 contas</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Pessoal + poupança</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-plume-blue-300 dark:hover:border-plume-blue-500 bg-gray-50 dark:bg-gray-700 cursor-pointer transition-colors">
                            <input type="radio" name="contas" value="C" class="sr-only">
                            <div class="flex-1">
                                <div class="font-medium text-gray-800 dark:text-gray-200">Múltiplas contas</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Pessoal, negócio, investimentos</div>
                            </div>
                            <div class="ml-3 h-5 w-5 border-2 border-gray-300 dark:border-gray-500 rounded-full radio-indicator"></div>
                        </label>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between">
                    <button type="button" id="prev-btn" class="px-6 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors hidden">
                        ← Anterior
                    </button>
                    <button type="button" id="next-btn" class="px-6 py-2 bg-plume-blue-600 hover:bg-plume-blue-700 text-white rounded-lg transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed ml-auto">
                        Próximo →
                    </button>
                    <button type="submit" id="submit-btn" class="px-6 py-2 bg-plume-teal-600 hover:bg-plume-teal-700 text-white rounded-lg transition-colors font-medium hidden">
                        Finalizar Configuração
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm w-full mx-4 shadow-xl">
            <div class="flex items-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-plume-blue-600 mr-3"></div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">A processar...</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">A criar a sua configuração personalizada</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentQuestion = 0;
        const totalQuestions = 5;
        const questions = document.querySelectorAll('.question-card');

        function updateProgress() {
            const progress = ((currentQuestion + 1) / totalQuestions) * 100;
            document.getElementById('progress-bar').style.width = progress + '%';
            document.getElementById('progress-text').textContent = `${currentQuestion + 1} de ${totalQuestions}`;
        }

        function showQuestion(index) {
            questions.forEach((q, i) => {
                q.classList.toggle('hidden', i !== index);
            });
            
            updateProgress();
            
            // Update navigation buttons
            document.getElementById('prev-btn').classList.toggle('hidden', index === 0);
            document.getElementById('next-btn').classList.toggle('hidden', index === totalQuestions - 1);
            document.getElementById('submit-btn').classList.toggle('hidden', index !== totalQuestions - 1);
            
            // Restore visual state for current question
            restoreVisualState(index);
        }
        
        function restoreVisualState(questionIndex) {
            const questionCard = questions[questionIndex];
            const checkedInput = questionCard.querySelector('input[type="radio"]:checked');
            
            if (checkedInput) {
                const indicator = checkedInput.parentElement.querySelector('.radio-indicator');
                const label = checkedInput.parentElement;
                
                // Apply selected styling
                indicator.classList.add('bg-plume-blue-600', 'border-plume-blue-600');
                indicator.classList.remove('border-gray-300', 'dark:border-gray-500');
                indicator.innerHTML = '<i class="ti ti-check text-white text-xs"></i>';
                
                // Highlight the selected label
                label.classList.add('border-plume-blue-300', 'dark:border-plume-blue-500', 'bg-plume-blue-50', 'dark:bg-plume-blue-900');
                label.classList.remove('border-gray-200', 'dark:border-gray-600');
            }
        }

        function validateCurrentQuestion() {
            const currentQuestionCard = questions[currentQuestion];
            const radioInputs = currentQuestionCard.querySelectorAll('input[type="radio"]');
            return Array.from(radioInputs).some(input => input.checked);
        }

        // Radio button styling
        document.querySelectorAll('input[type="radio"]').forEach(input => {
            input.addEventListener('change', function() {
                // Remove previous selection styling from all options in current question
                this.closest('.question-card').querySelectorAll('.radio-indicator').forEach(indicator => {
                    indicator.classList.remove('bg-plume-blue-600', 'border-plume-blue-600');
                    indicator.classList.add('border-gray-300', 'dark:border-gray-500');
                    indicator.innerHTML = ''; // Remove checkmark
                });
                
                // Remove border highlighting from all labels
                this.closest('.question-card').querySelectorAll('label').forEach(label => {
                    label.classList.remove('border-plume-blue-300', 'dark:border-plume-blue-500', 'bg-plume-blue-50', 'dark:bg-plume-blue-900');
                    label.classList.add('border-gray-200', 'dark:border-gray-600');
                });
                
                // Add styling to selected option
                const indicator = this.parentElement.querySelector('.radio-indicator');
                const label = this.parentElement;
                
                indicator.classList.add('bg-plume-blue-600', 'border-plume-blue-600');
                indicator.classList.remove('border-gray-300', 'dark:border-gray-500');
                indicator.innerHTML = '<i class="ti ti-check text-white text-xs"></i>'; // Add checkmark
                
                // Highlight the selected label
                label.classList.add('border-plume-blue-300', 'dark:border-plume-blue-500', 'bg-plume-blue-50', 'dark:bg-plume-blue-900');
                label.classList.remove('border-gray-200', 'dark:border-gray-600');
            });
        });

        // Next button
        document.getElementById('next-btn').addEventListener('click', function() {
            if (validateCurrentQuestion()) {
                currentQuestion++;
                showQuestion(currentQuestion);
            } else {
                alert('Por favor, selecione uma opção antes de continuar.');
            }
        });

        // Previous button
        document.getElementById('prev-btn').addEventListener('click', function() {
            currentQuestion--;
            showQuestion(currentQuestion);
        });

        // Form submission
        document.getElementById('onboarding-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateCurrentQuestion()) {
                alert('Por favor, responda à última pergunta antes de finalizar.');
                return;
            }

            document.getElementById('loading-overlay').classList.remove('hidden');

            // Collect form data
            const formData = new FormData(this);
            
            // Submit via AJAX
            fetch('{{ route("onboarding.process-answers") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    // Redirect to preview page
                    window.location.href = '{{ route("onboarding.preview") }}?template_id=' + data.template.id;
                } else {
                    alert('Erro ao processar as respostas: ' + (data.message || 'Erro desconhecido'));
                    document.getElementById('loading-overlay').classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro ao processar as respostas: ' + error.message);
                document.getElementById('loading-overlay').classList.add('hidden');
            });
        });

        // Initialize
        showQuestion(0);
        
        // Restore visual state for all questions on page load
        questions.forEach((question, index) => {
            restoreVisualState(index);
        });
    </script>
</x-app-layout>
