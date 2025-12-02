SELECT * FROM courses WHERE level = 'Intermediaire' AND title LIKE '101 %' ORDER BY title

SELECT level, COUNT(*) FROM courses GROUP BY level;