<div>
    <div class="flex items-center gap-10 justify-center pl-24">
        <label> Помещение<br><select name="room">
                <option value="all" selected>Все</option>
            </select></label>

        <label> Подразделение<br><select name="subdivision">
                <option value="all" selected>Все</option>
            </select></label>

        <label> Абонент<br><select name="subscriber">
                <option value="all" selected>Все</option>
            </select></label>

        <button class="px-12 py-3 rounded-xl bg-gray-200 mt-5">Показать номера</button>
        <?php if (\Src\Right\Right::suitableRight('admin')): ?>
            <button class="px-12 py-3 rounded-xl bg-gray-200 mt-5 ml-16">
                <a href="<?= app()->route->getUrl('/signup') ?>">Создать СисАдмина</a>
            </button>
        <?php endif; ?>
    </div>
    <div class="flex flex-wrap p-6 m-12 gap-5 justify-center border-4 rounded-xl border-gray-200">
        <div class="flex flex-col gap-2 bg-gray-400 py-8 px-16 rounded-xl">
            <span><span>Номер: </span>+7 777 777 77 77</span>
            <span><span>ФИО: </span>Вася Иванов Петрович</span>
            <span><span>Дата рождения: </span>09.10.2002</span>
        </div>
        <div class="flex flex-col gap-2 bg-gray-400 py-8 px-16 rounded-xl">
            <span><span>Номер: </span>+7 777 777 77 77</span>
            <span><span>ФИО: </span>Вася Иванов Петрович</span>
            <span><span>Дата рождения: </span>09.10.2002</span>
        </div>
        <div class="flex flex-col gap-2 bg-gray-400 py-8 px-16 rounded-xl">
            <span><span>Номер: </span>+7 777 777 77 77</span>
            <span><span>ФИО: </span>Вася Иванов Петрович</span>
            <span><span>Дата рождения: </span>09.10.2002</span>
        </div>
        <div class="flex flex-col gap-2 bg-gray-400 py-8 px-16 rounded-xl">
            <span><span>Номер: </span>+7 777 777 77 77</span>
            <span><span>ФИО: </span>Вася Иванов Петрович</span>
            <span><span>Дата рождения: </span>09.10.2002</span>
        </div>
        <div class="flex flex-col gap-2 bg-gray-400 py-8 px-16 rounded-xl">
            <span><span>Номер: </span>+7 777 777 77 77</span>
            <span><span>ФИО: </span>Вася Иванов Петрович</span>
            <span><span>Дата рождения: </span>09.10.2002</span>
        </div>
    </div>
    <div class="flex flex-wrap p-6 m-12 gap-5 justify-center border-4 rounded-xl border-gray-200">
        <form method="post" class="flex flex-col bg-gray-400 items-center p-12 w-96 rounded-xl gap-5">
            <h2>Телефонный номер</h2>
            <p>
                <label>Телефон <br><input type="tel" name="telephone" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <label>Помещение <br>
                    <select name="room_num" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200">
                        <option value="">some</option>
                    </select>
                <label>
            </p>
            <p>
                <label>Абонент <br>
                    <select name="subscriber_id" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200">
                        <option value="">some</option>
                    </select>
                <label>
            </p>
            <p>
                <input type="submit" value="Создать" class="px-12 py-3 rounded-xl bg-gray-200 mt-5" />
            </p>
        </form>
        <form method="post" class="flex flex-col bg-gray-400 items-center p-12 w-96 rounded-xl gap-5">
            <h2>Абонент</h2>
            <p>
                <label>Имя <br><input type="text" name="firstname" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <label>Фамилия <br><input type="text" name="lastname" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <label>Отчество <br><input type="text" name="patronymic" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <label>Дата рождения <br><input type="date" name="birth_date" class="border-4 rounded-xl w-36 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <input type="submit" value="Создать" class="px-12 py-3 rounded-xl bg-gray-200 mt-5" />
            </p>
        </form>
        <form method="post" class="flex flex-col bg-gray-400 items-center p-12 w-96 rounded-xl gap-5">
            <h2>Помещение</h2>
            <p>
                <label>Номер помещения <br><input type="number" name="room_num" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <label>Название <br><input type="text" name="name" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <label>Тип помещения <br><input type="text" name="type" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <label>Подразделение <br>
                    <select name="subdivision_id" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200">
                        <option value="">some</option>
                    </select>
                <label>
            </p>
            <p>
                <input type="submit" value="Создать" class="px-12 py-3 rounded-xl bg-gray-200 mt-5" />
            </p>
        </form>
        <form method="post" class="flex flex-col bg-gray-400 items-center p-12 w-96 rounded-xl gap-5">
            <h2>Подразделение</h2>
            <p>
                <label>Название <br><input type="text" name="name" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <label>Тип подразделения <br><input type="text" name="type" class="border-4 rounded-xl w-80 h-8 px-2 border-gray-200" /><label>
            </p>
            <p>
                <input type="submit" value="Создать" class="px-12 py-3 rounded-xl bg-gray-200 mt-5" />
            </p>
        </form>
    </div>
</div>
