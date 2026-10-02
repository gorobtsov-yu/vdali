<template>
    <div class="relative flex items-center justify-center min-h-screen bg-white overflow-hidden px-4">
        <div class="absolute -top-20 -left-20 w-72 h-72 bg-gradient-to-br from-sky-100 to-blue-200 rounded-full opacity-60 blur-2xl"></div>
        <div class="absolute -bottom-16 -right-16 w-56 h-56 bg-gradient-to-tl from-cyan-100 to-sky-200 rounded-full opacity-50 blur-2xl"></div>
        <div class="absolute top-1/3 right-10 w-32 h-32 bg-gradient-to-br from-blue-100 to-indigo-100 rotate-12 opacity-40 blur-xl rounded-lg"></div>
        <div class="absolute bottom-1/4 left-10 w-40 h-40 bg-gradient-to-tr from-cyan-200 to-blue-200 opacity-30 blur-xl" style="clip-path: polygon(50% 0%, 0% 100%, 100% 100%);"></div>

        <div class="relative z-10 text-center max-w-lg">
            <h1 class="text-9xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-400 via-gray-300 to-gray-200">
                404
            </h1>
            <h2 class="mt-4 text-3xl font-semibold text-gray-800">
                Страница не найдена
            </h2>
            <p class="mt-2 text-gray-500 text-lg">
                Извините, мы не можем найти запрашиваемую страницу.<br>
                Возможно, она была перемещена или удалена.
            </p>

            <router-link
                to="/"
                class="inline-flex items-center gap-2 mt-8 px-6 py-3 bg-gradient-to-r from-gray-400 to-gray-500 hover:from-gray-400 hover:to-blue-200 text-white font-medium rounded-xl shadow-md hover:shadow-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2"
            >
                <i class="fa fa-home" aria-hidden="true"></i>
                Вернуться на главную
            </router-link>
        </div>
    </div>
</template>