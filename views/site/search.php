<div>
    <div class="flex justify-center mt-6">
        <form method="get">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="text" name="search" class="border-4 rounded-xl w-96 h-10 px-2 border-gray-200" />
            <input type="submit" value="Поиск" class="px-12 py-3 rounded-xl bg-gray-200 mt-5 hover:opacity-75" />
        </form>
    </div>
    <div class="flex flex-wrap p-6 m-12 gap-5 justify-center border-4 rounded-xl border-gray-200">
        <?php foreach($subdivisions as $subdivision): ?>
            <div class="flex flex-col p-6 gap-5 justify-center border-4 rounded-xl border-gray-200">
                <span>Имя: <?= $subdivision->name ?></span>
                <span>Тип подразделения: <?= $subdivision->type ?></span>
                <img src="<?=$subdivision->image?>" alt="#" width="400" height="250" />
            </div>
        <?php endforeach; ?>
        <?php foreach($rooms as $room): ?>
            <div class="flex flex-col p-6 gap-5 justify-center border-4 rounded-xl border-gray-200">
                <span>Номер комнаты: №<?= $room->room_num ?></span>
                <span>Название: <?= $room->name ?></span>
                <span>Тип: <?= $room->type ?></span>
                <span>Подразделение: 
                    <?= \Model\Subdivision::where('subdivision_id', $room->subdivision_id)->first()->name?> |
                    <?= \Model\Subdivision::where('subdivision_id', $room->subdivision_id)->first()->type ?>
                </span>
                <img src="<?=$subdivision->image?>" alt="#" width="400" height="250" />
            </div>
        <?php endforeach; ?>
    </div>
</div>