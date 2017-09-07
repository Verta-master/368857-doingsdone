<div class="modal">
    <button class="modal__close" type="button" name="button">Закрыть</button>

    <h2 class="modal__heading">Добавление задачи</h2>

    <form class="form" class="" action="index.php" method="post" enctype="multipart/form-data">
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['name'] == '') print ('form__input--error'); ?>"
                   type="text" name="name" id="name" value="<?=$project;?>" placeholder="Введите название">
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['date'] == '') print('<span class="form__error">Заполните это поле</span>') ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['project'] == '') print ('form__input--error'); ?>"
                    name="project" id="project">
                <option value="input" <?php if ($folder == "input") print ('selected') ?> >Входящие</option>
                <option value="study" <?php if ($folder == "study") print ('selected') ?> >Учеба</option>
                <option value="work" <?php if ($folder == "work") print ('selected') ?> >Работа</option>
                <option value="home" <?php if ($folder == "home") print ('selected') ?> >Домашние дела</option>
                <option value="auto" <?php if ($folder == "auto") print ('selected') ?>>Авто</option>
            </select>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['date'] == '') print('<span class="form__error">Заполните это поле</span>') ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="date">Дата выполнения <sup>*</sup></label>

            <input class="form__input form__input--date <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['date'] == '') print ('form__input--error'); ?>"
                   type="text" name="date" id="date" value="<?=$date;?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['date'] == '') print('<span class="form__error">Заполните это поле</span>') ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
                <input class="visually-hidden" type="file" name="preview" id="preview" value="">

                <label class="button button--transparent" for="preview">
                    <span>Выберите файл</span>
                </label>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="submit" value="Добавить">
        </div>
    </form>
</div>