<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <form method="post" class="flex flex-col bg-gray-400 items-center p-12 w-96 mt-24 rounded-xl">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <h2 class="m-5 text-2xl">Авторизация</h2>
        <h3 class="text-[#9b2d30] mb-5"><?= $message ?? ''; ?></h3>
        <label>Логин<br> <input type="text" name="login" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200"></label><br>
        <label>Пароль<br> <input type="password" name="password" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200"></label><br>
        <button class="px-12 py-3 rounded-xl bg-gray-200 m-5">Войти</button>
    </form>
<?php endif;