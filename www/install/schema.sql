-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump
DROP SCHEMA public CASCADE;
CREATE SCHEMA public;

DROP TABLE IF EXISTS "esgi_comments" CASCADE;
DROP SEQUENCE IF EXISTS esgi_comments_id_seq;
CREATE SEQUENCE esgi_comments_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_comments" (
    "id" integer DEFAULT nextval('esgi_comments_id_seq') NOT NULL,
    "content" text,
    "page_id" integer,
    "date_created" timestamp DEFAULT CURRENT_TIMESTAMP,
    "statut_moderation" boolean DEFAULT false,
    "parent_id" integer,
    "user_name" character varying(255),
    CONSTRAINT "esgi_comments_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_menus" CASCADE;
DROP SEQUENCE IF EXISTS esgi_menus_id_seq;
CREATE SEQUENCE esgi_menus_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_menus" (
    "id" integer DEFAULT nextval('esgi_menus_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "page_id" integer,
    "order" integer NOT NULL,
    CONSTRAINT "esgi_menus_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_pages" CASCADE;
DROP SEQUENCE IF EXISTS esgi_pages_id_seq;
CREATE SEQUENCE esgi_pages_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_pages" (
    "id" integer DEFAULT nextval('esgi_pages_id_seq') NOT NULL,
    "title" character varying(255) NOT NULL,
    "content" text,
    "user_id" integer,
    "date_created" timestamp DEFAULT CURRENT_TIMESTAMP,
    "date_modified" timestamp,
    "url_page" text,
    "controller_page" character varying(255) NOT NULL,
    "action_page" character varying(255) NOT NULL,
    "used_template" integer,
    CONSTRAINT "esgi_pages_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO esgi_pages ("title", "content", "user_id", "date_created", "date_modified", "url_page", "controller_page", "action_page", "used_template") VALUES
('dashboard',	NULL,	NULL,	'2023-06-28 09:35:28.62323',	NULL,	'/dashboard',	'Main',	'dashboard',	NULL),
('contact',	NULL,	NULL,	'2023-06-28 09:36:18.308916',	NULL,	'/contact',	'Main',	'contact',	NULL),
('login',	NULL,	NULL,	'2023-06-28 09:36:52.399549',	NULL,	'/login',	'Security',	'login',	NULL),
('register',	NULL,	NULL,	'2023-06-28 09:38:51.893301',	NULL,	'/register',	'Security',	'register',	NULL),
('disconnect',	NULL,	NULL,	'2023-06-28 09:39:12.302641',	NULL,	'/disconnect',	'Security',	'disconnect',	NULL),
('verify',	NULL,	NULL,	'2023-06-28 09:39:30.914361',	NULL,	'/verify',	'Security',	'verify',	NULL),
('Choice Template Page',	NULL,	NULL,	'2023-06-28 12:39:00.307211',	NULL,	'/choice_template_page',	'Security',	'choiceTemplatePage',	NULL),
('edit_user',	NULL,	NULL,	'2023-06-28 12:44:33.291857',	NULL,	'/admin/edit_user',	'Admin',	'editUser',	NULL),
('delete_user',	NULL,	NULL,	'2023-06-28 12:45:14.6325',	NULL,	'/admin/delete_user',	'Admin',	'deleteUser',	NULL),
('add_template_page',	NULL,	NULL,	'2023-06-28 14:24:41.937919',	NULL,	'/add_template_page',	'Security',	'addTemplatePage',	NULL),
('Index',	NULL,	NULL,	'2023-06-29 06:56:39.827372',	NULL,	'/',	'Main',	'index',	NULL),
('components',	NULL,	NULL,	'2023-06-30 09:45:46.514237',	NULL,	'/components',	'Main',	'components',	NULL),
('install',	NULL,	NULL,	'2023-09-16 06:17:15.241603',	NULL,	'/install',	'Admin',	'install',	NULL),
('Create Page',	NULL,	NULL,	'2023-06-30 14:10:21.927364',	NULL,	'/create_page',	'Security',	'createPage',	NULL),
('page',	NULL,	NULL,	'2023-07-21 01:26:14.765273',	NULL,	'/page',	'Security',	'page',	NULL),
('delete_page',	NULL,	NULL,	'2023-06-28 12:45:14.6325',	NULL,	'/admin/delete_page',	'Admin',	'deletePage',	NULL),
('list_comment',	NULL,	NULL,	'2023-09-20 21:15:31.996981',	NULL,	'/list_comment',	'Security',	'listComment',	NULL),
('delete_comment',	NULL,	NULL,	'2023-09-20 23:00:11.619969',	NULL,	'/admin/delete_comment',	'Admin',	'deleteComment',	NULL),
('verify_comment',	NULL,	NULL,	'2023-09-20 23:05:54.698081',	NULL,	'/admin/verify_comment',	'Admin',	'verifyComment',	NULL),
('<p>Nunc aliquet bibendum enim facilisis</p>',	'{"type":"body","children":[{"type":"img","attributes":{"src":"ImagePage\\/Uploads\\/Nunc aliquet bibendum enim facilisis\\/Nunc aliquet bibendum enim facilisis+logo.png"}},{"type":"h1","children":["Nunc aliquet bibendum enim facilisis"]},{"type":"p","children":[{"type":"strong","children":["Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus sed vulputate odio ut enim blandit volutpat maecenas volutpat. Volutpat lacus laoreet non curabitur gravida arcu ac. Nisi est sit amet facilisis magna. Leo duis ut diam quam nulla porttitor massa id neque. Cursus turpis massa tincidunt dui ut ornare lectus. Vivamus arcu felis bibendum ut. Semper viverra nam libero justo laoreet. Cum sociis natoque penatibus et. Mauris commodo quis imperdiet massa. Quis imperdiet massa tincidunt nunc pulvinar. Eget dolor morbi non arcu risus quis varius quam."]}]},{"type":"p","children":[{"type":"em","children":["Velit scelerisque in dictum non consectetur a erat nam. Nisi quis eleifend quam adipiscing vitae. Nibh venenatis cras sed felis eget velit aliquet. A condimentum vitae sapien pellentesque habitant morbi tristique senectus et. Arcu bibendum at varius vel pharetra vel. Ligula ullamcorper malesuada proin libero nunc consequat. Tempus egestas sed sed risus pretium quam. Elementum nibh tellus molestie nunc non blandit massa enim. Ac tortor dignissim convallis aenean et tortor. Tellus in metus vulputate eu scelerisque."]}]},{"type":"p","children":[{"type":"span","attributes":{"style":{"color":"rgb(224, 62, 45)"}},"children":["Interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Sem viverra aliquet eget sit. Diam maecenas ultricies mi eget mauris. Faucibus vitae aliquet nec ullamcorper sit amet. Quis varius quam quisque id diam. Est ultricies integer quis auctor. Sit amet risus nullam eget felis eget. Turpis in eu mi bibendum neque. Blandit aliquam etiam erat velit scelerisque in. Sed euismod nisi porta lorem mollis aliquam. Pulvinar proin gravida hendrerit lectus. Elementum facilisis leo vel fringilla est ullamcorper eget nulla facilisi. Turpis massa sed elementum tempus egestas sed sed risus. Quis lectus nulla at volutpat diam ut venenatis. Porttitor lacus luctus accumsan tortor posuere ac ut consequat semper."]}]},{"type":"p","children":[{"type":"span","attributes":{"style":{"font-size":"18pt"}},"children":["Pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Diam quis enim lobortis scelerisque. Id diam maecenas ultricies mi. Quam vulputate dignissim suspendisse in est ante. Id velit ut tortor pretium viverra. Nunc aliquet bibendum enim facilisis. Consectetur libero id faucibus nisl tincidunt eget nullam non. Molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit sed. Urna cursus eget nunc scelerisque viverra mauris. Placerat orci nulla pellentesque dignissim enim sit amet. Tincidunt eget nullam non nisi est sit amet facilisis magna. Pellentesque habitant morbi tristique senectus. Dolor purus non enim praesent elementum facilisis leo vel fringilla. Lobortis elementum nibh tellus molestie nunc non blandit massa enim. Nisl rhoncus mattis rhoncus urna neque viverra justo nec ultrices. Sapien pellentesque habitant morbi tristique senectus et netus et malesuada. Diam quis enim lobortis scelerisque. Semper auctor neque vitae tempus quam pellentesque nec nam aliquam. Lectus quam id leo in vitae turpis."]}]},{"type":"p","children":[{"type":"span","attributes":{"style":{"font-family":"impact, sans-serif"}},"children":["Enim sit amet venenatis urna cursus eget nunc scelerisque viverra. Adipiscing elit ut aliquam purus. Feugiat pretium nibh ipsum consequat nisl vel pretium. Adipiscing at in tellus integer feugiat. In ante metus dictum at tempor commodo ullamcorper. Convallis posuere morbi leo urna molestie at elementum eu. Nec dui nunc mattis enim ut tellus elementum. Etiam tempor orci eu lobortis elementum nibh tellus. Sit amet justo donec enim diam vulputate ut. Volutpat lacus laoreet non curabitur gravida. Bibendum enim facilisis gravida neque. Eu turpis egestas pretium aenean pharetra magna. Ultrices vitae auctor eu augue. Viverra accumsan in nisl nisi scelerisque eu. Nisl vel pretium lectus quam id leo. Laoreet suspendisse interdum consectetur libero id faucibus. Euismod lacinia at quis risus sed vulputate. Accumsan in nisl nisi scelerisque eu ultrices vitae auctor. Turpis egestas sed tempus urna et pharetra."]}]}]}',	1,	'2023-09-21 06:11:10',	NULL,	'/nunc-aliquet-bibendum-enim-facilisis',	'Page',	'index',	1);

DROP TABLE IF EXISTS "esgi_roles" CASCADE;
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

DROP TABLE IF EXISTS "esgi_seo" CASCADE;
DROP SEQUENCE IF EXISTS esgi_seo_id_seq;
CREATE SEQUENCE esgi_seo_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_seo" (
    "id" integer DEFAULT nextval('esgi_seo_id_seq') NOT NULL,
    "title" character varying(255),
    "meta_description" character varying(255),
    "page_id" integer NOT NULL,
    CONSTRAINT "esgi_seo_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_templates" CASCADE;
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

INSERT INTO "esgi_templates" ("name", "description", "color", "police", "image") VALUES
('Article',	'<input id="41" type="file" name="imageSite+1" placeholder="Image de votre article">
<label for="41"><img src="public/image/image_en_attente.svg" alt="image_en_attente"></label> 
<input type="text" name="titleSite" placeholder="Titre de l''article"> <input type="text" name="texteSite" placeholder="Description de l''article"> <input type="text" name="texteSite" placeholder="Contenu de l''article">',	NULL,	NULL,	'public/image/templates/Article+pageArticle.png');

DROP TABLE IF EXISTS "esgi_tokens" CASCADE;
DROP SEQUENCE IF EXISTS esgi_tokens_id_seq;
CREATE SEQUENCE esgi_tokens_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_tokens" (
    "id" integer DEFAULT nextval('esgi_tokens_id_seq') NOT NULL,
    "user_id" integer NOT NULL,
    "token" character varying(255) NOT NULL,
    CONSTRAINT "esgi_tokens_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_users" CASCADE;
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


DROP TABLE IF EXISTS "esgi_categories";
DROP SEQUENCE IF EXISTS esgi_categories_id_seq;
CREATE SEQUENCE esgi_categories_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
CREATE TABLE "public"."esgi_categories" (
    "id" integer DEFAULT nextval('esgi_categories_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    CONSTRAINT "esgi_categories_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_categories" ("name") VALUES
('Actualités '),
('Technologie '),
('Santé '),
('Voyage '),
('Mode'),
('Culture ');

DROP TABLE IF EXISTS "esgi_page_categories";
DROP SEQUENCE IF EXISTS esgi_page_categories_id_seq;
CREATE SEQUENCE esgi_page_categories_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
CREATE TABLE "public"."esgi_page_categories" (
    "page_id" integer,
    "category_id" integer,
    PRIMARY KEY ("page_id", "category_id"),
    FOREIGN KEY ("page_id") REFERENCES esgi_pages(id) ON DELETE CASCADE,
    FOREIGN KEY ("category_id") REFERENCES esgi_categories(id) ON DELETE CASCADE
) WITH (oids = false);



ALTER TABLE ONLY "public"."esgi_comments" ADD CONSTRAINT "esgi_comments_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_menus" ADD CONSTRAINT "esgi_menus_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_pages" ADD CONSTRAINT "esgi_pages_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_seo" ADD CONSTRAINT "esgi_seo_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_tokens" ADD CONSTRAINT "fk_user_id" FOREIGN KEY (user_id) REFERENCES esgi_users(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_users" ADD CONSTRAINT "esgi_users_role_id_fkey" FOREIGN KEY (role_id) REFERENCES esgi_roles(id) NOT DEFERRABLE;
