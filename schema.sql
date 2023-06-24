-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump

\connect "esgi";

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
    CONSTRAINT "esgi_pages_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_roles";
DROP SEQUENCE IF EXISTS esgi_roles_id_seq;
CREATE SEQUENCE esgi_roles_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_roles" (
    "id" integer DEFAULT nextval('esgi_roles_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "description" text,
    CONSTRAINT "esgi_roles_nom_key" UNIQUE ("name"),
    CONSTRAINT "esgi_roles_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


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


DROP TABLE IF EXISTS "esgi_templates";
DROP SEQUENCE IF EXISTS esgi_templates_id_seq;
CREATE SEQUENCE esgi_templates_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_templates" (
    "id" integer DEFAULT nextval('esgi_templates_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "description" text,
    "color" character varying(7),
    "police" character varying(255),
    CONSTRAINT "esgi_templates_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_tokens";
DROP SEQUENCE IF EXISTS esgi_tokens_id_seq;
CREATE SEQUENCE esgi_tokens_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_tokens" (
    "id" integer DEFAULT nextval('esgi_tokens_id_seq') NOT NULL,
    "user_id" integer NOT NULL,
    "token" character varying(255) NOT NULL,
    CONSTRAINT "esgi_tokens_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_users";
DROP SEQUENCE IF EXISTS esgi_users_id_seq;
CREATE SEQUENCE esgi_users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_users" (
    "id" integer DEFAULT nextval('esgi_users_id_seq') NOT NULL,
    "firstname" character varying(255) NOT NULL,
    "lastname" character varying(255) NOT NULL,
    "email" character varying(255) NOT NULL,
    "password" character varying(255) NOT NULL,
    "role_id" integer,
    "verification_token" character varying(255),
    "email_verified" boolean DEFAULT false,
    "date_inserted" timestamptz DEFAULT CURRENT_TIMESTAMP,
    "date_updated" timestamptz,
    CONSTRAINT "esgi_users_email_key" UNIQUE ("email"),
    CONSTRAINT "esgi_users_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


ALTER TABLE ONLY "public"."esgi_comments" ADD CONSTRAINT "esgi_comments_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_comments" ADD CONSTRAINT "esgi_comments_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_menus" ADD CONSTRAINT "esgi_menus_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_pages" ADD CONSTRAINT "esgi_pages_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_seo" ADD CONSTRAINT "esgi_seo_page_id_fkey" FOREIGN KEY (page_id) REFERENCES esgi_pages(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_tokens" ADD CONSTRAINT "fk_user_id" FOREIGN KEY (user_id) REFERENCES esgi_users(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_users" ADD CONSTRAINT "esgi_users_role_id_fkey" FOREIGN KEY (role_id) REFERENCES esgi_roles(id) NOT DEFERRABLE;

-- 2023-06-24 15:17:38.029736+00