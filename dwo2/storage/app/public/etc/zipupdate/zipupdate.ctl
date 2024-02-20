LOAD DATA CHARACTERSET JA16SJIS
INFILE ''
TRUNCATE
INTO TABLE ZIP_MT
FIELDS TERMINATED BY ","
OPTIONALLY ENCLOSED BY '"'
TRAILING NULLCOLS
(
	jiscode FILLER,
	zip5 FILLER,
	zip_code,
	zip_pref_kana,
	zip_city_kana,
	zip_town_kana,
	zip_pref,
	zip_city,
	zip_town
)
