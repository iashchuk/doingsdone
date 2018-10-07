        <h2 class="content__main-heading">Добавление задачи</h2>
         <form class="form" enctype="multipart/form-data" action="/add.php" method="post">
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <input class="form__input <?php if (isset($errors["name"])): ?>form__input--error<?php endif; ?>" type="text" name="name" id="name" value="<?=$new_task['name']; ?>" placeholder="Введите название">
             <?php if (isset($errors["name"])): ?>
              <p class="form__message">
                <span class="error-message">
                  <?=$errors["name"]; ?>
                </span>
              </p>
            <?php endif; ?>
           </div>
           <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>
             <select class="form__input form__input--select" name="project" id="project">
              <?php foreach ($projects as $project): ?>
                <option value="<?=strip_tags($project["id"]); ?>"><?=strip_tags($project['title']); ?></option>
              <?php endforeach; ?>
            </select>
             <?php if (isset($errors["project"])): ?>
              <p class="form__message">
                <span class="error-message">
                  <?=$errors["project"]; ?>
                </span>
              </p>
            <?php endif; ?>
           </div>
           <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>
             <input class="form__input form__input--date" type="date" name="date" id="date" value="<?=$new_task["date"]; ?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
          </div>
           <div class="form__row">
            <label class="form__label" for="preview">Файл</label>
             <div class="form__input-file">
              <input class="visually-hidden" type="file" name="preview" id="preview" value="">
               <label class="button button--transparent" for="preview">
                <span>Выберите файл</span>
              </label>
            </div>
          </div>
           <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
