# добавление информации в БД
INSERT INTO users SET email = 'ignat.v@gmail.com',
  user_name = 'Игнат',
  password = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka';
INSERT INTO users SET email = 'kitty_93@li.ru',
  user_name = 'Леночка',
  password = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa';
INSERT INTO users SET email = 'warrior07@mail.ru',
  user_name = 'Руслан',
  password = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW';

INSERT INTO projects SET project_name = 'Все';
INSERT INTO projects SET project_name = 'Входящие';
INSERT INTO projects SET project_name = 'Учеба';
INSERT INTO projects SET project_name = 'Работа';
INSERT INTO projects SET project_name = 'Домашние дела';
INSERT INTO projects SET project_name = 'Авто';

INSERT INTO tasks SET task_name = 'Собеседование в IT компании',
  deadline = '01.06.2018',
  performed = '',
  author_id = '1',
  project_id = '4';
INSERT INTO tasks SET task_name = 'Выполнить тестовое задание',
  deadline = '25.05.2018',
  performed = '',
  author_id = '1',
  project_id = '4';
INSERT INTO tasks SET task_name = 'Сделать задание первого раздела',
  deadline = '21.04.2018',
  performed = '21.04.2018',
  author_id = '1',
  project_id = '3';
INSERT INTO tasks SET task_name = 'Встреча с другом',
  deadline = '22.04.2018',
  performed = '',
  author_id = '1',
  project_id = '2';
INSERT INTO tasks SET task_name = 'Купить корм для кота',
  performed = '',
  author_id = '1',
  project_id = '5';
INSERT INTO tasks SET task_name = 'Заказать пиццу',
  performed = '',
  author_id = '1',
  project_id = '5';

# получить список из всех проектов для одного пользователя
SELECT project_name FROM projects p
  JOIN users u
  ON p.author_id = u.id;

# получить список из всех задач для одного проекта
SELECT task_name FROM tasks t
  JOIN projects p
  ON t.project_id = p.id;

# пометить задачу как выполненную
UPDATE tasks SET performed = '20.09.2017' WHERE task_name = 'Купить корм для кота';

# получить все задачи для завтрашнего дня
SELECT task_name FROM tasks WHERE deadline = '20.09.2017';

# обновить название задачи по её идентификатору
UPDATE tasks SET task_name = 'Новое название' WHERE id = 3;
