-- ----------------------------
-- Create database and default data for "www.colour.name".
-- 2018-12-01 phi@gress.ly
--
-- --------------------------------------
USE               `farbnamen` ;
SET NAMES         'utf8'      ;
SET CHARACTER SET 'utf8'      ;

SET @DEMO_IP := 1234567890;

CALL sp_insertNomination('rötlich'            , @DEMO_IP, 140, 110, 110, 1, 1, '2018-12-14 08:44:55', 'de', @dummy);
CALL sp_insertNomination('grünlich'           , @DEMO_IP, 110, 140, 110, 1, 1, '2018-12-14 08:44:56', 'de', @dummy);
CALL sp_insertNomination('bläulich'           , @DEMO_IP, 110, 110, 140, 1, 2, '2018-12-14 08:44:57', 'de', @dummy);
CALL sp_insertNomination('cyan'               , @DEMO_IP,   0, 255, 255, 2, 1, '2018-12-14 08:44:58', 'en', @dummy);
CALL sp_insertNomination('yellow'             , @DEMO_IP, 200, 200,  10, 2, 1, '2018-12-14 08:44:59', 'en', @dummy);
CALL sp_insertNomination('black'              , @DEMO_IP,   0,  10,  12, 2, 1, '2018-12-14 08:45:00', 'en', @dummy);
CALL sp_insertNomination('jaune'              , @DEMO_IP, 250, 253,  18, 1, 1, '2018-12-14 08:45:01', 'fr', @dummy);
CALL sp_insertNomination('bleu'               , @DEMO_IP,  11,   5,  90, 2, 1, '2018-12-14 08:45:02', 'fr', @dummy);
CALL sp_insertNomination('blau'               , @DEMO_IP,  11,   5, 190, 2, 1, '2018-12-14 08:45:03', 'de', @dummy);
CALL sp_insertNomination('grün'               , @DEMO_IP,  44,  88,   2, 1, 1, '2018-12-14 08:45:04', 'de', @dummy);
CALL sp_insertNomination('dunkelgrün'         , @DEMO_IP,  44,  88,   2, 2, 1, '2018-12-14 08:45:04', 'de', @dummy);



CALL sp_insertNomination('rouge'              , @DEMO_IP, 255,   0,   0, 2, 1, '2018-12-14 08:45:04', 'fr', @dummy);
CALL sp_insertNomination('bleu'               , @DEMO_IP,   0, 255,   0, 1, 1, '2018-12-14 08:45:04', 'fr', @dummy);
CALL sp_insertNomination('vert foncé'         , @DEMO_IP,  44,  88,   2, 2, 1, '2018-12-14 08:45:04', 'fr', @dummy);


-- -------------------------
-- einige französische Namen von Wikipedia (2018-12 fr.wikipedia.org)
CALL sp_insertNomination('Aurore'             , @DEMO_IP, 255, 203,  96, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Bisque'             , @DEMO_IP, 255, 228, 196, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Capucine'           , @DEMO_IP, 255,  94,  77, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Incarnat'           , @DEMO_IP, 255, 111, 125, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Jaune de Naples'    , @DEMO_IP, 255, 240, 188, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Jaune impérial'     , @DEMO_IP, 255, 228,  54, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Magenta'            , @DEMO_IP, 255,   0, 255, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Maïs'               , @DEMO_IP, 255, 222, 117, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Or'                 , @DEMO_IP, 255, 215,   0, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rouge feu'          , @DEMO_IP, 255,  73,   1, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Soufre'             , @DEMO_IP, 255, 255, 107, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Vermeil'            , @DEMO_IP, 255,   9,  33, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Blanc cassé'        , @DEMO_IP, 254, 254, 226, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Cuisse de nymphe'   , @DEMO_IP, 254, 231, 240, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Écru'               , @DEMO_IP, 254, 254, 224, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Jaune mimosa'       , @DEMO_IP, 254, 248, 108, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Mandarine'          , @DEMO_IP, 254, 163,  71, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Paille'             , @DEMO_IP, 254, 227,  71, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Coquille d''œuf'    , @DEMO_IP, 253, 233, 224, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Fuchsia'            , @DEMO_IP, 253,  63, 146, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Jaune de cobalt'    , @DEMO_IP, 253, 238,   0, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Bouton d''or'       , @DEMO_IP, 252, 220,  18, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Nacarat'            , @DEMO_IP, 252,  93,  93, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Orpiment (pigment)' , @DEMO_IP, 252, 210,  28, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Lin'                , @DEMO_IP, 250, 240, 230, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Topaze'             , @DEMO_IP, 250, 234, 115, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Saumon'             , @DEMO_IP, 248, 142,  85, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Jaune citron'       , @DEMO_IP, 247, 255,  60, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Nankin'             , @DEMO_IP, 247, 226, 105, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rouge anglais'      , @DEMO_IP, 247,  35,  12, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Blanc lunaire'      , @DEMO_IP, 244, 254, 254, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Carotte'            , @DEMO_IP, 244, 102,  27, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Ambre'              , @DEMO_IP, 240, 195,   0, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Beurre'             , @DEMO_IP, 240, 227, 107, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Jaune d''or'        , @DEMO_IP, 239, 216,   7, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Garance (pigment)'  , @DEMO_IP, 238,  16,  16, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Jaune de Mars'      , @DEMO_IP, 238, 209,  83, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Écarlate'           , @DEMO_IP, 237,   0,   0, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Grenadine'          , @DEMO_IP, 233,  56,  63, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Blé'                , @DEMO_IP, 232, 214,  48, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Blond vénitien'     , @DEMO_IP, 231, 168,  84, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Corail'             , @DEMO_IP, 231,  62,   1, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Jaune canari'       , @DEMO_IP, 231, 240,  13, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Abricot'            , @DEMO_IP, 230, 126,  48, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Flave'              , @DEMO_IP, 230, 230, 151, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Blond'              , @DEMO_IP, 226, 188, 116, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Gueules'            , @DEMO_IP, 226,  19,  19, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Vanille'            , @DEMO_IP, 225, 206, 154, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rubis'              , @DEMO_IP, 224,  17,  95, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Sable'              , @DEMO_IP, 224, 205, 169, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Citrouille'         , @DEMO_IP, 223, 109,  20, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Héliotrope'         , @DEMO_IP, 223, 115, 255, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Ocre'               , @DEMO_IP, 223, 175,  44, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Tomate'             , @DEMO_IP, 222,  41,  22, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Ocre rouge'         , @DEMO_IP, 221, 152,  92, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Cramoisi'           , @DEMO_IP, 220,  20,  60, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Cinabre'            , @DEMO_IP, 219,  23,   2, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Vermillon'          , @DEMO_IP, 219,  23,   2, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Orchidée'           , @DEMO_IP, 218, 112, 214, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Pelure d''oignon'   , @DEMO_IP, 213, 132, 144, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Mauve'              , @DEMO_IP, 212, 115, 212, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Chamois'            , @DEMO_IP, 208, 192, 122, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Groseille'          , @DEMO_IP, 207,  10,  29, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Parme'              , @DEMO_IP, 207, 160, 233, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Gris perle'         , @DEMO_IP, 206, 206, 206, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Caca d''oie'        , @DEMO_IP, 205, 205,  13, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rouge indien'       , @DEMO_IP, 205,  92,  92, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Orange brûlé'       , @DEMO_IP, 204,  85,   0, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Pervenche'          , @DEMO_IP, 204, 204, 255, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Glycine'            , @DEMO_IP, 201, 160, 220, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Framboise'          , @DEMO_IP, 199,  44,  72, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Moutarde'           , @DEMO_IP, 199, 207,   0, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Ponceau'            , @DEMO_IP, 198,   8,   0, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Argent'             , @DEMO_IP, 192, 192, 192, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Fraise'             , @DEMO_IP, 191,  48,  48, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Pistache'           , @DEMO_IP, 190, 245, 116, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Fumée'              , @DEMO_IP, 187, 210, 225, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Grège'              , @DEMO_IP, 187, 174, 152, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rouge cerise'       , @DEMO_IP, 187,  11,  11, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Tourterelle'        , @DEMO_IP, 187, 172, 172, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rouge cardinal'     , @DEMO_IP, 184,  32,  16, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Lilas'              , @DEMO_IP, 182, 102, 210, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Poil de chameau'    , @DEMO_IP, 182, 120,  35, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Cuivre'             , @DEMO_IP, 179, 103,   0, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Mastic'             , @DEMO_IP, 179, 177, 145, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Vert d''eau'        , @DEMO_IP, 176, 242, 182, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Gris acier'         , @DEMO_IP, 175, 175, 175, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Baillet'            , @DEMO_IP, 174, 100,  45, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rouge tomette'      , @DEMO_IP, 174,  74,  52, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Sépia'              , @DEMO_IP, 174, 137, 100, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Aquilain'           , @DEMO_IP, 173,  79,   9, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Fauve'              , @DEMO_IP, 173,  79,   9, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Roux'               , @DEMO_IP, 173,  79,   9, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Lie de vin'         , @DEMO_IP, 172,  30,  68, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rouge d''Andrinople', @DEMO_IP, 169,  17,   1, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Alezan'             , @DEMO_IP, 167, 103,  38, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Vert tilleul'       , @DEMO_IP, 165, 209,  82, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Fraise écrasée'     , @DEMO_IP, 164,  36,  36, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Tabac'              , @DEMO_IP, 159,  85,  30, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Gris souris'        , @DEMO_IP, 158, 158, 158, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Lime ou vert citron', @DEMO_IP, 158, 253,  56, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Pourpre héraldique' , @DEMO_IP, 158,  14,  64, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Auburn'             , @DEMO_IP, 157,  62,  12, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rose Mountbatten'   , @DEMO_IP, 153, 122, 141, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Rouille'            , @DEMO_IP, 152,  87,  23, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Carmin'             , @DEMO_IP, 150,   0,  24, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Lavande'            , @DEMO_IP, 150, 131, 236, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Noisette'           , @DEMO_IP, 149,  86,  40, 1, 1, '2018-12-15 08:45:04','fr', @dummy);
CALL sp_insertNomination('Vert-de-gris'       , @DEMO_IP, 149, 165, 149, 2, 1, '2018-12-15 08:45:04','fr', @dummy);
