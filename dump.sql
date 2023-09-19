-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_comments";
DROP SEQUENCE IF EXISTS esgi_comments_id_seq;
CREATE SEQUENCE esgi_comments_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_comments" (
    "id" integer DEFAULT nextval('esgi_comments_id_seq') NOT NULL,
    "content" text,
    "user_id" integer NOT NULL,
    "page_id" integer NOT NULL,
    "date_created" timestamp DEFAULT CURRENT_TIMESTAMP,
    "statut_moderation" boolean DEFAULT false,
    CONSTRAINT "esgi_comments_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_configurations";
DROP SEQUENCE IF EXISTS esgi_configurations_id_seq;
CREATE SEQUENCE esgi_configurations_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_configurations" (
    "id" integer DEFAULT nextval('esgi_configurations_id_seq') NOT NULL,
    "configuration_key" character varying(255) NOT NULL,
    "configuration_value" text NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp
) WITH (oids = false);

INSERT INTO "esgi_configurations" ("id", "configuration_key", "configuration_value", "created_at", "updated_at") VALUES
(2,	'table_prefix',	'esgi_',	NULL,	NULL),
(1,	'site_name',	'Le site trop cool',	NULL,	NULL);

DROP TABLE IF EXISTS "esgi_menus";
DROP SEQUENCE IF EXISTS esgi_menus_id_seq;
CREATE SEQUENCE esgi_menus_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_menus" (
    "id" integer DEFAULT nextval('esgi_menus_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "page_id" integer,
    "order" integer NOT NULL,
    CONSTRAINT "esgi_menus_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_pages";
DROP SEQUENCE IF EXISTS esgi_pages_id_seq;
CREATE SEQUENCE esgi_pages_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_pages" (
    "id" integer DEFAULT nextval('esgi_pages_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "content" text,
    "user_id" integer NOT NULL,
    "date_created" timestamp DEFAULT CURRENT_TIMESTAMP,
    "date_modified" timestamp,
    "url_page" text,
    "controller_page" character varying(255) NOT NULL,
    "action_page" character varying(255) NOT NULL,
    "used_template" character varying(255),
    CONSTRAINT "esgi_pages_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_pages" ("id", "title", "content", "user_id", "date_created", "date_modified", "url_page", "controller_page", "action_page", "used_template") VALUES
(2,	'dashboard',	NULL,	126,	'2023-06-28 09:35:28.62323',	NULL,	'/dashboard',	'Main',	'dashboard',	NULL),
(3,	'contact',	NULL,	126,	'2023-06-28 09:36:18.308916',	NULL,	'/contact',	'Main',	'contact',	NULL),
(4,	'login',	NULL,	126,	'2023-06-28 09:36:52.399549',	NULL,	'/login',	'Security',	'login',	NULL),
(5,	'logout',	NULL,	126,	'2023-06-28 09:37:34.418299',	NULL,	'/logout',	'Security',	'logout',	NULL),
(7,	'disconnect',	NULL,	126,	'2023-06-28 09:39:12.302641',	NULL,	'/disconnect',	'Security',	'disconnect',	NULL),
(8,	'verify',	NULL,	126,	'2023-06-28 09:39:30.914361',	NULL,	'/verify',	'Security',	'verify',	NULL),
(96,	'install',	NULL,	126,	'2023-09-16 06:17:15.241603',	NULL,	'/install',	'Admin',	'install',	NULL),
(12,	'delete_user',	NULL,	127,	'2023-06-28 12:45:14.6325',	NULL,	'/admin/delete_user',	'Admin',	'deleteUser',	NULL),
(11,	'edit_user',	NULL,	127,	'2023-06-28 12:44:33.291857',	NULL,	'/admin/edit_user',	'Admin',	'editUser',	NULL),
(100,	'ded',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/ded\\/ded+logo fla.png"}},"dedLa FLA a permis de jouer contre de nombreuse equipe lors d\''un tournoi"]}',	126,	'2023-09-18 14:42:54',	NULL,	'/ded',	'Page',	'index',	'Article'),
(13,	'add_template_page',	NULL,	126,	'2023-06-28 14:24:41.937919',	NULL,	'/add_template_page',	'Security',	'addTemplatePage',	NULL),
(14,	'Index',	NULL,	126,	'2023-06-29 06:56:39.827372',	NULL,	'/',	'Main',	'index',	NULL),
(6,	'register',	NULL,	126,	'2023-06-28 09:38:51.893301',	NULL,	'/register',	'Security',	'register',	NULL),
(15,	'components',	NULL,	127,	'2023-06-30 09:45:46.514237',	NULL,	'/components',	'Main',	'components',	NULL),
(9,	'Choice Template Page',	NULL,	126,	'2023-06-28 12:39:00.307211',	NULL,	'/choice_template_page',	'Security',	'choiceTemplatePage',	NULL),
(16,	'Create Page',	NULL,	126,	'2023-06-30 14:10:21.927364',	NULL,	'/create_page',	'Security',	'createPage',	NULL),
(72,	'page',	NULL,	126,	'2023-07-21 01:26:14.765273',	NULL,	'/page',	'Security',	'page',	NULL),
(76,	'delete_page',	NULL,	127,	'2023-06-28 12:45:14.6325',	NULL,	'/admin/delete_page',	'Admin',	'deletePage',	NULL);

DROP TABLE IF EXISTS "esgi_roles";
DROP SEQUENCE IF EXISTS esgi_roles_id_seq;
CREATE SEQUENCE esgi_roles_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_roles" (
    "id" integer DEFAULT nextval('esgi_roles_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "description" text,
    "create_pages" boolean DEFAULT false NOT NULL,
    "edit_pages" boolean DEFAULT false NOT NULL,
    "delete_pages" boolean DEFAULT false NOT NULL,
    "publish_pages" boolean DEFAULT false NOT NULL,
    "manage_users" boolean DEFAULT false NOT NULL,
    CONSTRAINT "esgi_roles_nom_key" UNIQUE ("name"),
    CONSTRAINT "esgi_roles_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_roles" ("id", "name", "description", "create_pages", "edit_pages", "delete_pages", "publish_pages", "manage_users") VALUES
(1,	'Admin',	NULL,	't',	't',	't',	't',	't'),
(2,	'Editor',	NULL,	't',	't',	'f',	'f',	'f'),
(3,	'Author',	NULL,	't',	't',	'f',	'f',	'f'),
(4,	'Contributor',	NULL,	't',	't',	'f',	'f',	'f'),
(5,	'Subscriber',	NULL,	'f',	'f',	'f',	'f',	'f'),
(6,	'None',	NULL,	'f',	'f',	'f',	'f',	'f');

DROP TABLE IF EXISTS "esgi_seo";
DROP SEQUENCE IF EXISTS esgi_seo_id_seq;
CREATE SEQUENCE esgi_seo_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_seo" (
    "id" integer DEFAULT nextval('esgi_seo_id_seq') NOT NULL,
    "title" character varying(255),
    "meta_description" character varying(255),
    "page_id" integer NOT NULL,
    CONSTRAINT "esgi_seo_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_smtp";
DROP SEQUENCE IF EXISTS esgi_smtp_id_seq;
CREATE SEQUENCE esgi_smtp_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_smtp" (
    "id" integer DEFAULT nextval('esgi_smtp_id_seq') NOT NULL,
    "username" character varying(255) NOT NULL,
    "password" character varying(255) NOT NULL,
    CONSTRAINT "esgi_smtp_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_smtp" ("id", "username", "password") VALUES
(1,	'louisgauvainpro@gmail.com',	'jnoafumntdvjhxsd');

DROP TABLE IF EXISTS "esgi_templates";
DROP SEQUENCE IF EXISTS esgi_templates_id_seq;
CREATE SEQUENCE esgi_templates_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_templates" (
    "id" integer DEFAULT nextval('esgi_templates_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "description" text,
    "color" character varying(7),
    "police" character varying(255),
    "image" character varying(3000),
    CONSTRAINT "esgi_templates_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_templates" ("id", "name", "description", "color", "police", "image") VALUES
(56,	'Acceuil',	'<input type="text" name="titleSite" placeholder="Titre de l''acceuil"> <input id="15" type="file" name="imageSite+1" placeholder="Baniere de l''acceuil"><label for="15"><img src="public/image/image_en_attente.svg" alt="image_en_attente"></label> <input type="text" name="texteSite" placeholder="Contenu de l''acceuil">',	NULL,	NULL,	'Templates/Uploads/2023/07/Acceuil+pageAcceuil.png'),
(55,	'Blog',	'<input type="text" name="titleSite" placeholder="Titre de la page Blog"> <input id="25" type="file" name="imageSite+1" placeholder="Image du premier contenu"><label for="25"><img src="public/image/image_en_attente.svg" alt="image_en_attente"></label> <input type="text" name="texteSite" placeholder="Premier contenu"> <input id="26" type="file" name="imageSite+2" placeholder="Image du deuxieme contenu"><label for="25"><img src="public/image/image_en_attente.svg" alt="image_en_attente"></label> <input type="text" name="texteSite" placeholder="Deuxieme contenu">',	NULL,	NULL,	'Templates/Uploads/2023/07/Blog+pageBlog.png'),
(54,	'Article',	'<input id="41" type="file" name="imageSite+1" placeholder="Image de votre article">
<label for="41"><img src="public/image/image_en_attente.svg" alt="image_en_attente"></label> 
<input type="text" name="titleSite" placeholder="Titre de l''article"> <input type="text" name="texteSite" placeholder="Description de l''article"> <input type="text" name="texteSite" placeholder="Contenu de l''article">',	NULL,	NULL,	'Templates/Uploads/2023/07/Article+pageArticle.png');

DROP TABLE IF EXISTS "esgi_tokens";
DROP SEQUENCE IF EXISTS esgi_tokens_id_seq;
CREATE SEQUENCE esgi_tokens_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_tokens" (
    "id" integer DEFAULT nextval('esgi_tokens_id_seq') NOT NULL,
    "user_id" integer NOT NULL,
    "token" character varying(255) NOT NULL,
    CONSTRAINT "esgi_tokens_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_tokens" ("id", "user_id", "token") VALUES
(114,	126,	'723b04439ebc1599608214aa91faad4fefffed9baec5276659a0fafc77c74190'),
(127,	126,	'4568075592d89d16b12382209a846c3c0251fdd38743aff44d0636e340f781ae'),
(115,	126,	'a38cbc74561c6a70548d46ac7ec29562fa1ec6c3cb08639576e31664987f913f'),
(116,	126,	'922ca93705d76d84720486ffd1c79cd09ea3cd7aafd87e050d98f4a66e1ddaba'),
(117,	126,	'db6293d6f19e966eb8c9a7f28d928c5322df95dfa8fc26ffdbd67785f3f8857a'),
(118,	126,	'6864dfde1aed59fc21d113dd3d06b1fedd8c01ad5bdb571df0d8b869296e5563'),
(174,	136,	'3ea2e0a3118288e63087e2c47605d6ba98414ec2be75b3591f5ca9717b52f0db'),
(132,	127,	'91206d0a0e8814b0d5548f8b9246cf96c1d5fe31ffe3ea299aca3700a2e2ace5'),
(176,	126,	'5ae735e7f8c65c64e4df407a94feebe95430fea649225c0c319484c87e476006'),
(149,	126,	'edd5fa9530e87ed95f6e104aced2fb78e1d780c829d2d5b1c715b991f9a4d38a'),
(133,	127,	'890caa8baeb8a7fe240cd728ca04a006b7bdaa9cdf04240db0adc0a8b3c115de'),
(134,	127,	'3a3407da22795879572732c2b894520c511ddb7419079d40921a0fcc8bee172e'),
(135,	127,	'a79e006ea4338eff61947adf8f2fc9df46361e55262ce636676b2120df6a22cb'),
(129,	126,	'963eb32e730a3c9b938f4e30e9b6ed37de4f0ff19f5a1931bc6d4d0b5719fef6'),
(170,	126,	'10a16599879f7e6933b0c4ddd386f372a69832794b5a8a8b3bcb9ae1c7f8795f'),
(130,	126,	'ed17bdef1834ad365a5221cbb22846a5473d58675eda7ef5ef66ee825805a791'),
(175,	126,	'3269a8ab0d1ee4be87a3744f9d3d7675af09a9f45895679711b5658e8a50ad8e'),
(136,	126,	'1efca2a708bff4c5130bcfecb11a0fa6ce81791c80d2631f4c7dd7b71e197731'),
(137,	126,	'cc712d19eb68da09f15c00bd262c8f41fbb98eeb169bc3d5107903db9ce233ea'),
(156,	127,	'494e94d5b84289fbe042947d60df51dc7401b7104e6c71cf805355154f930763'),
(143,	126,	'0f8aa68cf244b6a44ed73ee77663143af7f9d448868ae6e524b898c9bf9b0243'),
(128,	127,	'f7ed0f4436581005ff40bb3bca70eb6547b304327f243034c8d6e7f6438b3fd6'),
(124,	127,	'32348090c5e8247adb0175d4adf3b82ed4b3002288afe34174404cd97ad32fbb'),
(153,	127,	'467a6645e3bb557e79280d4f8bbdb9ee1e208deb6569b24173fd030ef0487e59'),
(142,	127,	'da312d06b0273db1d1ac497f3f301810f93e1bdc66351c5edbce37acf908d92f'),
(140,	127,	'c0ea259a64e94d733d97aa14c32dc8fc26611fc65620503c4d6002f4d676a87c'),
(138,	126,	'74e905fc4049fa8b3393d36a1316e8140a18fedc17ceb751d85933ed9f2f6ddc'),
(125,	127,	'b704561bc33dbd06c2a89a7b959709b95552d276142ae32b015e6e2c432414f4'),
(144,	126,	'94c2ee72a15cd5ea8a0be90af556350d832cbb12d76ce93f2a7c6fc68e0b1db7'),
(154,	127,	'cc2ada822675a265af73258c3d8cf4a0e08be0b53115b1bba75822fb8e312fcb'),
(150,	126,	'8fb31b584f04e6ace6caab971d8e5039d0a0b3a0f9804d024a0179c4e86c3eee'),
(169,	126,	'df534adc53315e8de7ad1ab4d1be455e2ba9bb92faca39daaaf247fa2d33edf5'),
(110,	126,	'b737729b3ed197c77d6b2aa09416d96eae916ed5d69c043408417c039fb76587'),
(145,	126,	'eafa66b4e8423336b05e2b15bcc7cdb78bf82830dbd3adb370c3f656c3296058'),
(111,	126,	'2b9775f146f8de2e799c0ae1dd3a67d7e17f10c1609a94ab449ab75e4ffe7b9d'),
(112,	126,	'e068de4ff35a6166c29cb805bc1803ba8940008e6ac592a408206a93c2a3bff6'),
(113,	126,	'33a38ddcf46e474dacae66f62373351f99d3f67066ba5ae791700745c75bb6cb'),
(131,	126,	'cbcbb04a131e86ecef0c24c0f3192211281c9220be7cc5b38df21ba0f400f8eb'),
(126,	127,	'5abfd8559a9dcb8ed4eb45f89ab1a6e25957f6d93390701c936d2033db388118'),
(160,	126,	'f1897e6451d80cd462659a37408bf038a7de3469c4e2fef10f4f5ac76d0cb171'),
(168,	127,	'81d3d1a5d454141f4fa9d63c24723a9b38262ddb7af8a5c01fac65416e692985'),
(164,	126,	'cf9737f1a68b11860e027e96b763608ee48bc5c2b94a1eef1d852ff59e3428f9'),
(157,	126,	'77ca5091eec749bd73c0a7978fb8fdd4eae050d95cc05376b36018d8bff57685'),
(155,	127,	'4df336fe4ef75e2e6a108b82ad613d47521ff2844db234c80625aef7061d2c83'),
(139,	127,	'4c34f73fce5f0d59ff38df965b0e129796f8a6f6d67119b570e06d11f8ad08e7'),
(141,	127,	'31b8d79515650bbc8c50a9bfa1da1a5ffe2eebc0d8587e6f6af858ebada8bbe5'),
(146,	127,	'28ad392eabd6be660af6fc225268fd60140729f19e4ea90ebc6d84f5a0218953'),
(162,	126,	'423024c17a654b64a2fc343d7a271f00fe8b5db4c7f761124eca6efdacfcc180'),
(148,	126,	'fe37145d589203f26490a36c99476f2f04314de3d5bc1c18b365db9c180d9d38'),
(147,	126,	'5c68abe12a3e4e3337f99afece399b667f6b95dd5d5d8986aa5f175e1226caf5'),
(158,	126,	'46b54b864be5b06111ecad16007eb1b2b06311640c3f2eb02a4684cf7daa260c'),
(151,	127,	'76cc31ad27511c9cb881bb8e21208ccb13f1a8b3553b127c574b9a48b5c01a41'),
(152,	126,	'7ab7da81bc704341b96cba3ae55b0fb360ad506f3b0b8a4ffdf78e71b4ac58dd'),
(159,	126,	'87ea6b7baba7ca009cc64df6c674474c4a615dd67c53d9d0c4e8cef59a40d3dc'),
(166,	126,	'0192d5e67ba11b14540c1f3d086c70302b8e86f17eb25b9842d52e7e5e76d2de'),
(161,	126,	'685eca276905ae29b7afa55eedd23d65623efebc3be7ab7ea2768331be436414'),
(163,	126,	'd077bfe89dd39c547cf68282c6936434eb82e8eb3fe9ec7564c689e1d0a08ea5'),
(167,	126,	'94204b4aadcac646d368955345c28981771c809d33bcd13cce62f73aa3859091'),
(172,	127,	'283c45ef5ddeda5b3cedc602b42dc0f79e8e6216ca5b99bf485f5283fabe7829'),
(165,	136,	'c924463923ef9c555d23fa5d5a66d3801b7b9e93d020bc97c1a631b9db77c01e'),
(171,	127,	'60f16164730777db1afeeaa76b7602545d461924ca4aedf8a081f2261fde1384'),
(177,	126,	'd4724e84747a71d094ed76d218350733fed19db109e9efb7f8577564c43efd40'),
(179,	126,	'c05163dcb1ef6ef464773a89d244d4e8dd733aa1f861310b66d534e10bb27bb3'),
(181,	126,	'a6391921022d00610044bb52a193aa8442faf31417e91f5b90671e2fe5a2e286'),
(178,	126,	'5f35532ac42a52238af3827f751574c76f25694d96c84a6f19263cc58690a037'),
(173,	127,	'294e13c50bcb5d207c241cbe56dcba1f225213f442319e8a1f10cd5720fca9f5'),
(185,	136,	'f7bcd3aeb0b35aabde82a7cb4496dba89b976a6c946d48bb223bdfe0717ddd58'),
(187,	136,	'35915f57fe822c10be474061269d87c2e638bc8519643fccbab99689b96c42d5'),
(188,	136,	'26bcf6d9f5712b141eeb06a75ff061462b7b6f7b49856ad7956dad717937362a'),
(186,	142,	'f80a217f50d42a45c32a8fd7ddab22cc7c43191612932419ebeff2a102946e5a'),
(189,	143,	'63ee0400cea59fafd6edc04c2a8b45c2ad490c0fdffcfb1d4635ec0647677687'),
(192,	136,	'cd05ead9d3f81a2ac70011b44d85d122d8eb9cc2835980f6ec2c353dc5f36142'),
(193,	142,	'e5d36944dd57d94d2e1e50850f8332ff4a625594550f8856ff068a06de1f9528'),
(194,	126,	'6551f2b42ff9339a56ef4a22f07fb0e525dcac7ab80840b09b756dedff3d46c8'),
(195,	126,	'71d8e63ae8b9ae73110f68fd8e5a207e9064e2cb0b06f3c71dc296c0e8458add'),
(196,	126,	'29fa3063270efcdb6fdc394b108b255a5263123d56de544a981dcf292c3989a6'),
(191,	144,	'5b254d8bb88dec74c175de3e872642773c030deb23ffdec4f81aa17d4815ff7b'),
(207,	126,	'5eb96a9e39bc887d4ebd7c45a032878de562ece4de6aac1ed098ed0414124538'),
(197,	126,	'a0206ea44cc9e7c86c23cba9bdf191ccbc79529f00dd77a5d4b59e64e4a46a71'),
(198,	126,	'64f8c45bfb81cf22c08c25545fca9ff1914d63a5a884eaa82185d901f1cb68eb'),
(199,	126,	'bc06233ed2aa85789a5fe2e35e761c8e059be9a4167d6b5b1d828c19e8419be3'),
(200,	126,	'130f65c3c877a351e6160345188acb907eac8458b2e1fe1b6e7b077b534a8e39'),
(201,	126,	'889ddf49407de35f91b8ce40b8648c4c9fedb7306be9903148d252e13071a3ff'),
(202,	126,	'6afc2728a17725f40e42dba09b39df6e223bf7ce5ff1483ee2d578e47fa4f82e'),
(203,	126,	'3eb8fd14ac1d05ba23275d2714593c1d13bb3db082185f349442e4f9fa0ac8f9'),
(208,	126,	'8a6c1b679ba035036215275a389aa1ed0230eb2154f2f3a72c5af61accec6e6b'),
(209,	126,	'dce558ef868f26c3c70b949b2d617d95ea97137510adc30df4e60120c70d705a'),
(210,	126,	'fb705fde53a9d9dc75d52b48ed7f2d077949f0d013b2dbe5f80b1a6e34855f98'),
(190,	143,	'4702041ffbb7a2bcc7b467cb4858be3bb1ca0950b0ed3ca95c0cbd88c206417c'),
(211,	126,	'c04bc2ebf08d994a02da3858d335325ee47cefda8ece46237bfcda84431a27b7'),
(204,	126,	'bf3eb953876ebe53731d8beed95fbab071541cc753f9888eddce39d63462d569'),
(205,	126,	'bea98a21308768b7eab510e375097de463e3196e4da9c50e43c5e1399544d30f'),
(212,	126,	'892ecc20d57ecece96e44ca468a0a03a67734ce7682a16656d96a2009e354e33'),
(206,	126,	'c4780a8665aa3df1a740ab74bc371fe951875630cc5ec8a281441974b04628c9'),
(213,	126,	'0463976aa01d4f65935dec4e8e49d014fea9c0e7e891db2bf598e5e957fe2e0a');

DROP TABLE IF EXISTS "esgi_users";
DROP SEQUENCE IF EXISTS esgi_users_id_seq;
CREATE SEQUENCE esgi_users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_users" (
    "id" integer DEFAULT nextval('esgi_users_id_seq') NOT NULL,
    "firstname" character varying(255) NOT NULL,
    "lastname" character varying(255) NOT NULL,
    "email" character varying(255) NOT NULL,
    "password" character varying(255) NOT NULL,
    "role_id" integer DEFAULT '6' NOT NULL,
    "verification_token" character varying(255),
    "email_verified" boolean DEFAULT false,
    "date_inserted" timestamp DEFAULT CURRENT_TIMESTAMP,
    "date_updated" timestamp,
    CONSTRAINT "esgi_users_email_key" UNIQUE ("email"),
    CONSTRAINT "esgi_users_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_users" ("id", "firstname", "lastname", "email", "password", "role_id", "verification_token", "email_verified", "date_inserted", "date_updated") VALUES
(136,	'Nathanael',	'BUGUELLOU',	'n.buguellou@laposte.net',	'$2y$10$wr5yYgnkNna/zcaeH4x4x.bilYdO/unsjxHR1LZUrx0MAi.5zKXn6',	1,	'b9d11c0b7b98f88dcca0af4e1c4efad1e2a3357ba33b643a67881a01d940dbac',	't',	NULL,	NULL),
(127,	'Thomas',	'STEPHAN',	'thomas.stephan@live.fr',	'$2y$10$R2EEEuAbRNJg0CTs3QgZDuM2L6VbjWoQwXd9NhVoXziPb2e6e5i8e',	1,	'ce2002d7e4e2af21a6a299fb54543e148e1603075083b9b5a1f7b78ee194f14a',	't',	NULL,	NULL),
(126,	'Louis',	'GAUVAIN',	'louis230201@gmail.com',	'$2y$10$hiA7R09FhNcLPQoCPjauu.kF44UuqU5PPUxYROLXxSHqvRCRIYnPe',	1,	'1b5635c13a38a6b695dff22a091f0fe31d9c46be376882c960bf683727443425',	't',	NULL,	NULL),
(144,	'Nath',	'BUG',	'natsusansblague@gmail.com',	'$2y$10$Gf7xIZpjhBUY9LFO1goBv.T.pXNkJufT6hi8TlLF8vUYmC.JTXrH.',	6,	'2ba4b58920c429252a69e1d2956b6c125d38587a421549f647752721d090a60f',	't',	NULL,	'2023-09-18 11:54:46'),
(142,	'Toto',	'TOTO',	'y.skrzypczyk@gmail.com',	'$2y$10$UVPszHCPKbndqtxPoZLYVeOAdZX8Y07TnFYi/a6RobsvEhKl0a9k2',	6,	'cbe499ab4b6ddc45b7fd9d2836f14fd8e6ace1fcf2562a6892950ad096072580',	't',	NULL,	'2023-07-21 07:12:16'),
(143,	'Thomas',	'DOMINGUES',	'tdomingues@myges.fr',	'$2y$10$rLQkYVwSTcCM9/BgFktUBeTotFTOXnFG9jfwLtNlwQifqahNfB.AS',	6,	'18018c8ed333dc7054689c0d45fadd0be28f25482af741f3dc6bc9af06383b79',	't',	NULL,	'2023-09-18 12:12:35');

ALTER TABLE ONLY "public"."esgi_comments" ADD CONSTRAINT "esgi_comments_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_comments" ADD CONSTRAINT "esgi_comments_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_menus" ADD CONSTRAINT "esgi_menus_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_pages" ADD CONSTRAINT "esgi_pages_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_seo" ADD CONSTRAINT "esgi_seo_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_tokens" ADD CONSTRAINT "fk_user_id" FOREIGN KEY (user_id) REFERENCES esgi_users(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_users" ADD CONSTRAINT "esgi_users_role_id_fkey" FOREIGN KEY (role_id) REFERENCES esgi_roles(id) NOT DEFERRABLE;

-- 2023-09-19 17:13:38.646265+00