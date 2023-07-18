-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_comments" CASCADE;
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
    CONSTRAINT "esgi_pages_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_pages" ("id", "title", "content", "user_id", "date_created", "date_modified", "url_page", "controller_page", "action_page") VALUES
(2,	'dashboard',	NULL,	NULL,	'2023-06-28 09:35:28.62323',	NULL,	'/dashboard',	'Main',	'dashboard'),
(3,	'contact',	NULL,	NULL,	'2023-06-28 09:36:18.308916',	NULL,	'/contact',	'Main',	'contact'),
(4,	'login',	NULL,	NULL,	'2023-06-28 09:36:52.399549',	NULL,	'/login',	'Security',	'login'),
(5,	'logout',	NULL,	NULL,	'2023-06-28 09:37:34.418299',	NULL,	'/logout',	'Security',	'logout'),
(6,	'register',	'',	NULL,	'2023-06-28 09:38:51.893301',	NULL,	'/register',	'Security',	'register'),
(7,	'disconnect',	NULL,	NULL,	'2023-06-28 09:39:12.302641',	NULL,	'/disconnect',	'Security',	'disconnect'),
(8,	'verify',	NULL,	NULL,	'2023-06-28 09:39:30.914361',	NULL,	'/verify',	'Security',	'verify'),
(9,	'page',	NULL,	NULL,	'2023-06-28 12:39:00.307211',	NULL,	'/page',	'Security',	'page'),
(12,	'delete_user',	NULL,	NULL,	'2023-06-28 12:45:14.6325',	NULL,	'/admin/delete_user',	'Admin',	'deleteUser'),
(11,	'edit_user',	NULL,	NULL,	'2023-06-28 12:44:33.291857',	NULL,	'/admin/edit_user',	'Admin',	'editUser'),
(13,	'hadTemplatePage',	NULL,	NULL,	'2023-06-28 14:24:41.937919',	NULL,	'/hadTemplatePage',	'Security',	'hadTemplatePage');

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

ALTER TABLE ONLY "public"."esgi_comments" ADD CONSTRAINT "esgi_comments_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_comments" ADD CONSTRAINT "esgi_comments_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_menus" ADD CONSTRAINT "esgi_menus_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_pages" ADD CONSTRAINT "esgi_pages_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_seo" ADD CONSTRAINT "esgi_seo_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_tokens" ADD CONSTRAINT "fk_user_id" FOREIGN KEY (user_id) REFERENCES esgi_users(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_users" ADD CONSTRAINT "esgi_users_role_id_fkey" FOREIGN KEY (role_id) REFERENCES esgi_roles(id) NOT DEFERRABLE;
