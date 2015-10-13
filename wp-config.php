<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

define('FS_METHOD','direct');

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'shkap');

/** Имя пользователя MySQL */
define('DB_USER', 'web');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'webdb');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '9pxU*fb9C|OVGC+fd8Zh-lz~!C7hf{WS%L|@9!y?!t DedC9Qk6(?R@$=SR~/k9z');
define('SECURE_AUTH_KEY',  '5Z*kfn(!%~U)F)^%R*E8(.$t)  mEyEX0Jh{b*wt-bn}TtPb_F|/_8IGTGQA;Ka<');
define('LOGGED_IN_KEY',    'p|&z!:,[]4uFNY-7e(x4`.=LG2A(>,D4c%}f.BuDL9T UQeF2;F$]sGE3!5NQZZ*');
define('NONCE_KEY',        'fE,-1%k]PMN}?msp.,z*QT%5v*J0AF85DG@rB+k7CVfq)(96^`F3[Ur7#%^*% Nj');
define('AUTH_SALT',        '?(wK._JHU*gOvG_#CdriQ_68i+}Gx~rD@#Hp)1ci}MZ(%^J=g+J_O2,p|~pmJ@v8');
define('SECURE_AUTH_SALT', 'X:EohuLW-22Hkvq3XFm9(r%mA<-Bo93qIPh8gkh2++,tkr24e&Io;-y+aM:n%Rw]');
define('LOGGED_IN_SALT',   '{!)WN?~^C$m0{1O-Pa<SXn`c1+kcl|fwP6Y[o+NyqN<w]5eqY^o|w.qQT,iA}8N+');
define('NONCE_SALT',       'VP8+9!,`$g9+Of2@v;,8lm -QK2@>]wW5m,X$HYKCtjzlB:XeG%KX[>{y_9IqJA;');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
