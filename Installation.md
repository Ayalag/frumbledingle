You've made it this far! But this is your next challenge!

## DATABASE PREPARE
-- Database: Frumbledingle

-- DROP DATABASE IF EXISTS "Frumbledingle";

CREATE DATABASE "Frumbledingle"
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'English_United States.1252'
    LC_CTYPE = 'English_United States.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

COMMENT ON DATABASE "Frumbledingle"
    IS 'Frumbledingle Corp';

GRANT ALL ON DATABASE "Frumbledingle" TO postgres;

GRANT TEMPORARY, CONNECT ON DATABASE "Frumbledingle" TO PUBLIC;


