ALTER TABLE rep_db.user_log ADD CONSTRAINT user_log_FK_1 FOREIGN KEY (user_role) REFERENCES rep_db.user_role(ur_id);
ALTER TABLE rep_db.user_log ADD CONSTRAINT user_log_FK FOREIGN KEY (user_id) REFERENCES rep_db.student(user_id);
ALTER TABLE rep_db.user_log DROP FOREIGN KEY user_log_FK;
ALTER TABLE rep_db.user_log ADD CONSTRAINT user_log_FK FOREIGN KEY (user_id) REFERENCES rep_db.student(user_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE rep_db.student MODIFY COLUMN created_by int(11) NULL;
