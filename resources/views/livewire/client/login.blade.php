<div class="min-h-screen bg-gradient-to-br from-blue-900 to-blue-700 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="mx-auto h-12 w-auto flex justify-center">
                <x-logo />
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                Área do Cliente
            </h2>
            <p class="mt-2 text-center text-sm text-blue-100">
                Acesse sua conta para acompanhar suas solicitações
            </p>
        </div>

        <form wire:submit="login" class="mt-8 space-y-6">
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input wire:model="email"
                           id="email"
                           name="email"
                           type="email"
                           required
                           class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="E-mail">
                    @error('email') <span class="text-red-300 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="sr-only">Senha</label>
                    <input wire:model="password"
                           id="password"
                           name="password"
                           type="password"
                           required
                           class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Senha">
                    @error('password') <span class="text-red-300 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input wire:model="remember"
                           id="remember"
                           name="remember"
                           type="checkbox"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-blue-100">
                        Lembrar-me
                    </label>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Entrar
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-blue-100">
                    Ainda não possui conta? Suas credenciais são criadas automaticamente ao enviar uma solicitação.
                </p>
                <div class="mt-4 space-y-2">
                    <a href="{{ route('forms.cat') }}"
                       class="text-blue-200 hover:text-white underline block">
                        Solicitar CAT
                    </a>
                    <a href="{{ route('forms.ppp') }}"
                       class="text-blue-200 hover:text-white underline block">
                        Solicitar PPP
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>