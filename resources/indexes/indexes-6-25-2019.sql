CREATE FULLTEXT INDEX poet_name_index ON users (name);
CREATE FULLTEXT INDEX poet_bio_index ON users (bio);
CREATE FULLTEXT INDEX poet_email_index ON users (email);
CREATE FULLTEXT INDEX poem_title_index ON poetry (title);
CREATE FULLTEXT INDEX poem_prose_index ON poetry (poem);
CREATE FULLTEXT INDEX poem_meaning_index ON poetry (meaning);
