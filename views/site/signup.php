<form method="post" class="flex flex-col bg-gray-400 items-center p-12 w-96 mt-24 rounded-xl gap-5">
    <h2 class="text-2xl text-center">Регистрация СисАдмина</h2>
    <h3 class="text-[#9b2d30] mb-5"><?= $message ?? ''; ?></h3>
    <label>Логин <input type="text" name="login" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200"></label>
    <label>Пароль <input type="password" name="password" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200"></label>
    <button class="px-12 py-3 rounded-xl bg-gray-200 m-5">Создать</button>
</form>
