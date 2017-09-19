# добавление информации в БД
INSERT INTO users SET email = 'ignat.v@gmail.com',
  user_name = 'Игнат',
  password = 'ug0GdVMi';
INSERT INTO users SET email = 'kitty_93@li.ru',
  user_name = 'Леночка',
  password = 'daecNazD';
INSERT INTO users SET email = 'warrior07@mail.ru',
  user_name = 'Руслан',
  password = 'oixb3aL8';

INSERT INTO projects SET project_name = 'Все';
INSERT INTO projects SET project_name = 'Входящие';
INSERT INTO projects SET project_name = 'Учеба';
INSERT INTO projects SET project_name = 'Работа';
INSERT INTO projects SET project_name = 'Домашние дела';
INSERT INTO projects SET project_name = 'Авто';

INSERT INTO tasks SET task_name = 'Собеседование в IT компании',
  deadline = '01.06.2018',
  performed = FALSE;
INSERT INTO tasks SET task_name = 'Выполнить тестовое задание',
  deadline = '25.05.2018',
  performed = FALSE;
INSERT INTO tasks SET task_name = 'Сделать задание первого раздела',
  deadline = '21.04.2018',
  performed = TRUE;
INSERT INTO tasks SET task_name = 'Встреча с другом',
  deadline = '22.04.2018',
  performed = FALSE;
INSERT INTO tasks SET task_name = 'Купить корм для кота',
  performed = FALSE;
INSERT INTO tasks SET task_name = 'Заказать пиццу',
  performed = FALSE;

# получить список из всех проектов для одного пользователя
SELECT project_name FROM projects p
  JOIN users u
  ON p.author_id = u.id;

# получить список из всех задач для одного проекта
SELECT task_name FROM tasks t
  JOIN projects p
  ON t.project_id = p.id;

# пометить задачу как выполненную (беру случайную задачу)
UPDATE tasks SET performed = TRUE WHERE task_name = 'Купить корм для кота';

# получить все задачи для завтрашнего дня
SELECT task_name FROM tasks WHERE deadline = '20.09.2017';

# обновить название задачи по её идентификатору (непонятно в какой таблице, поэтому беру tasks)
UPDATE tasks SET task_name = 'Новое название' WHERE id = 3;
