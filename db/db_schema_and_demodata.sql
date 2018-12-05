-- ----------------------------
-- Create database and default data for "www.colour.name".
-- 2018-12-01 phi@gress.ly
--

DROP   DATABASE   IF EXISTS `farbnamen` ;
CREATE DATABASE             `farbnamen` ;

ALTER  DATABASE             `farbnamen`
       DEFAULT CHARACTER SET 'utf8'
       DEFAULT COLLATE 'utf8_general_ci';
USE                         `farbnamen` ;

-- create default user for development
-- CHANGE FOR REAL PRODUCTIVE SYSTEM!
GRANT SELECT, INSERT ON `farbnamen`.* TO 'coloresV4'@'%' IDENTIFIED BY '123';


-- --------------------------------------------------------

CREATE TABLE `begriff` (
  `ID`      tinyint NOT NULL
, `Kuerzel` char(6) NOT NULL COMMENT 'LCD, w, m, f_bl, etc.'
, PRIMARY KEY(`ID`)
) COMMENT='Sprachunabhängige Begriffe i. d. r. englisches Kuerzel';

INSERT INTO `begriff`
(`ID`, `Kuerzel`) VALUES
(  1 , 'LCD'    ),
(  2 , 'CRT'    ),
(  3 , 'LED'    ),
(  4 , 'AMOLED' ),
(  5 , 'Plasma' ),
(  6 , 'Photo'  ),
(  7 , 'Laser'  ),
(  8 , 'Inkjet' ),
(  9 , 'other'  ),
( 10 , '???'    ),
( 11 , 'w'      ),
( 12 , 'm'      ),
( 13 , '*GB'    ),
( 14 , 'R*B'    ),
( 15 , 'RG*'    ),
( 16 , 'rgb'    ),
( 17 , 'R**'    ),
( 18 , '*G*'    ),
( 19 , '**B'    ),
( 20 , 'IPS'    );


-- --------------------------------------------------------

CREATE TABLE `farbnamen` (
  `ID`   int  NOT NULL AUTO_INCREMENT
, `Name` text NOT NULL COMMENT 'Name der Farbe'
, PRIMARY KEY (`ID`)
) COMMENT='Namen der Farben, die in der Tabelle RGB auftreten';

INSERT INTO `farbnamen`
(`ID`, `Name`     ) VALUES
(   1, 'cyan'     ),
(   2, 'mandarine');


-- --------------------------------------------------------

CREATE TABLE `ipV4` (
  `ID`    int NOT NULL AUTO_INCREMENT
, `v4Int` int NOT NULL COMMENT 'Int Wert 32-Bit unsigned. 0, falls per Tabelle eingespeist'
, PRIMARY KEY(`ID`)
) COMMENT='IP Adresse zwecks späterer Identifikation der Regionen';

INSERT INTO `ipV4`
(`ID`, `v4Int`   ) VALUES
(  1 , 1426219562),
(  2 , 1414157270);


-- --------------------------------------------------------

CREATE TABLE `medium` (
  `ID`        tinyint NOT NULL AUTO_INCREMENT
, `F_begriff` tinyint NOT NULL COMMENT 'Link auf Kurzbeschreibung LCD, CRT, PLSM, Pap, ALED etc.'
, `sortOrder` tinyint NOT NULL DEFAULT '0'
, PRIMARY KEY(`ID`)
, FOREIGN KEY(`F_begriff`) REFERENCES `begriff` (`ID`)
) COMMENT='LCD, CRT, AMOLED, Papier, ...';

INSERT INTO `medium`
(`ID`, `F_begriff`, `sortOrder`) VALUES
(  1 ,          1 ,          5 ),
(  2 ,          2 ,         15 ),
(  3 ,          3 ,         20 ),
(  4 ,          4 ,         25 ),
(  5 ,          5 ,         30 ),
(  6 ,          6 ,         35 ),
(  7 ,          7 ,         40 ),
(  8 ,          8 ,         45 ),
(  9 ,          9 ,         50 ),
( 10 ,         10 ,         55 ),
( 11 ,         20 ,         10 );


-- --------------------------------------------------------

CREATE TABLE `netzhaut` (
  `ID`        tinyint NOT NULL AUTO_INCREMENT
, `F_begriff` tinyint NOT NULL COMMENT 'Link auf Kurzbegriff m, w, f_rg, f_b, _fb2, '
, `sortOrder` tinyint NOT NULL DEFAULT '0'
, PRIMARY KEY(`ID`)
, FOREIGN KEY(`F_begriff`) REFERENCES `begriff` (`ID`)
) COMMENT='Weiblich, Männlich, diverse Farbenblindheiten';

INSERT INTO `netzhaut`
(`ID`, `F_begriff`, `sortOrder`) VALUES
(  1 ,         11 ,          5 ),
(  2 ,         12 ,         10 ),
(  3 ,         13 ,         15 ),
(  4 ,         14 ,         20 ),
(  5 ,         15 ,         25 ),
(  6 ,         16 ,         30 ),
(  7 ,         17 ,         35 ),
(  8 ,         18 ,         40 ),
(  9 ,         19 ,         45 );


-- --------------------------------------------------------

CREATE TABLE `rgb` (
  `ID` int              NOT NULL AUTO_INCREMENT
, `R`  tinyint unsigned NOT NULL
, `G`  tinyint unsigned NOT NULL
, `B`  tinyint unsigned NOT NULL
, PRIMARY KEY (`ID`)
) COMMENT='R = red, G = green, B = blue';

INSERT INTO `rgb`
(`ID`,  `R`,  `G`,  `B`) VALUES
(  1 ,  37 , 207 , 230 ),
(  2 , 255 , 207 ,  56 );


-- --------------------------------------------------------

CREATE TABLE `sprache` (
  `ID`        varchar(3) NOT NULL COMMENT 'en, de, fr, it, es, ...'
, `Orig_Name` text       NOT NULL COMMENT 'Sprachname in der eigenen Sprache: english, deusch, italiano, ...'
, PRIMARY KEY(`ID`)
) COMMENT='Sprache mit ISO Code';

INSERT INTO `sprache`
(`ID` , `Orig_Name`       ) VALUES
('af' , 'Afrikaans'       ),
('as' , 'অসমীয়া'          ),
('ast', 'Asturianu'       ),
('be' , 'беларуская'      ),
('br' , 'Brezhoneg'       ),
('brx', 'बोडो'           ),
('bs' , 'Bosanski'        ),
('ca' , 'Català'          ),
('cs' , 'Čeština'         ),
('cy' , 'Welsh/Cymraeg'   ),
('da' , 'Dansk'           ),
('de' , 'Deutsch'         ),
('dgo', 'डोगरी'           ),
('el' , 'ελληνική'        ),
('en' , 'English'         ),
('eo' , 'Esperanto'       ),
('es' , 'Español'         ),
('et' , 'Eesti keel'      ),
('eu' , 'Euskara'         ),
('fi' , 'Suomi'           ),
('fr' , 'Français'        ),
('ga' , 'Gaeilge'         ),
('gd' , 'Gàidhlig'        ),
('gl' , 'Galego'          ),
('hr' , 'Hrvatski'        ),
('hu' , 'Magyar'          ),
('id' , 'Bahasa Indonesia'),
('is' , 'Íslenska'        ),
('it' , 'Italiano'        ),
('ka' , 'ქართული'         ),
('kk' , 'Қазақша'         ),
('kok', 'कोंकणी'           ),
('ks' , 'ﻚﺸﻤﻳﺮﻳ'          ),
('ku' , 'Kurdí'           ),
('lb' , 'Lëtzebuergesch'  ),
('lo' , 'ພາສາລາວ'         ),
('lt' , 'Lietuvių kalba'  ),
('lv' , 'Latviešu'        ),
('mai', 'मैथिली'           ),
('mn' , 'монгол'          ),
('mni', 'মৈইতৈইলোন'       ),
('nb' , 'Bokmål'          ),
('nl' , 'Nederlands'      ),
('nn' , 'Nynorsk'         ),
('nr' , 'Ndébélé'         ),
('nso', 'Sesotho sa Leboa'),
('oc' , 'Occitan'         ),
('om' , 'Afaan Oromo'     ),
('pl' , 'Polski'          ),
('pt' , 'Português'       ),
('ro' , 'Romån'           ),
('ru' , 'Русский'         ),
('rw' , 'KinyaRwanda'     ),
('sat', 'संथाली'           ),
('sd' , 'ﺲﻧﺩھی'           ),
('sh' , 'Srpski latinicom'),
('si' , 'සිංහල'            ),
('sk' , 'Slovenčina'      ),
('sl' , 'Slovenščina'     ),
('sq' , 'Shqip'           ),
('ss' , 'SiSwati'         ),
('st' , 'Sesotho'         ),
('sv' , 'Svenska'         ),
('tg' , 'тоҷикӣ'          ),
('th' , 'ภาษาไทย'         ),
('tn' , 'Setswana'        ),
('tr' , 'Türkçe'          ),
('ts' , 'Xitsonga'        ),
('tt' , 'татар теле'      ),
('ug' , 'ﺉۇﻲﻏۇﺭچە'        ),
('ve' , 'Tshivenḓa'       ),
('xh' , 'IsiXhosa'        ),
('zh' , '中文'            ),
('zu' , 'IsiZulu'         );


-- --------------------------------------------------------

CREATE TABLE `text` (
  `ID`        int        NOT NULL AUTO_INCREMENT
, `F_sprache` varchar(3) NOT NULL
, `F_begriff` tinyint    NOT NULL
, `Text`      text       NOT NULL
, PRIMARY KEY(`ID`)
, FOREIGN KEY(`F_sprache`) REFERENCES `sprache`(`ID`)
, FOREIGN KEY(`F_begriff`) REFERENCES `begriff`(`ID`)
);

INSERT INTO `text`
(`F_sprache`, `F_begriff`, `Text`                                        ) VALUES
(       'de',          1 , 'Flüssigkristallbildschirm (LCD)'             ),
(       'en',          1 , 'Liquid Crystal Display (LCD)'                ),
(       'fr',          1 , 'Écran à cristaux liquides (ACL/LCD)'         ),

(       'de',          2 , 'Kathodenstrahlröhre (CRT)'                   ),
(       'en',          2 , 'Cathode ray tube (CRT)'                      ),
(       'fr',          2 , 'Tube cathodique'                             ),

(       'de',          3 , 'Leuchtdiode (LED)'                           ),
(       'en',          3 , 'light emitting diode (LED)'                  ),
(       'fr',          3 , 'Diode électroluminescente (DEL/LED)'         ),

(       'de',          4 , 'Organische Leuchtdiode (AMOLED)'             ),
(       'en',          4 , 'active organic light emitting diode (AMOLED)'),
(       'de',          4 , 'Matrice Active OLED (AMOLED)'                ),

(       'de',          5 , 'Plasmabildschirm'                            ),
(       'en',          5 , 'Plasma display'                              ),
(       'fr',          5 , 'Plasma display'                              ),

(       'de',          6 , 'Photo (Aus-)druck'                           ),
(       'en',          6 , 'Photo print'                                 ),
(       'fr',          6 , 'Papier photographique'                       ),

(       'de',          7 , 'Laserdruck Normalpapier'                     ),
(       'en',          7 , 'Laser printer paper'                         ),
(       'fr',          7 , 'Impression laser'                            ),

(       'de',          8 , 'Tintenstrahldrucker Normalpapier'            ),
(       'en',          8 , 'Inkjet normal paper'                         ),
(       'fr',          8 , 'imprimante à jet d''encre [COMP.]'           ),

(       'de',          9 , 'Anderes Medium (nicht aufgelistet)'          ),
(       'en',          9 , 'Other output (not listed)'                   ),
(       'fr',          9 , 'Différent (ou «ne pas dans la liste»)'       ),

(       'de',         10 , '(mir) unbekannt'                             ),
(       'en',         10 , '(I) don''t know'                             ),
(       'fr',         10 , 'Je ne sais pas'                              ),

(       'de',         11 , 'weiblich'                                    ),
(       'en',         11 , 'female'                                      ),
(       'fr',         11 , 'feminin'                                     ),

(       'de',         12 , 'männlich'                                    ),
(       'en',         12 , 'male'                                        ),
(       'fr',         12 , 'masculin'                                    ),

(       'de',         13 , 'Rotblindheit (Protanopie)'                   ),
(       'en',         13 , 'red-blind (Protanopie)'                      ),
(       'fr',         13 , 'daltonien, daltonienne ROUGE'                ),

(      'de',          14 , 'Grünblindheit (Deuteranopie)'                ),
(      'en',          14 , 'green-blind (Deuteranopie)'                  ),
(      'fr',          14 , 'daltonien, daltonienne VERT'                 ),

(      'de',          15 , 'Blaublindheit (Tritanopie)'                  ),
(      'en',          15 , 'blue-blind (Tritanopie)'                     ),
(      'fr',          15 , 'daltonien, daltonienne BLEU'                 ),

(      'de',          16 , 'Farbschwäche (Anomale Trichromasie)'         ),
(      'en',          16 , 'color reduced (Anomal trichromasie)'         ),
(      'fr',          16 , 'déficit de vision couleur'                   ),

(      'de',          17 , 'Rot-Monochromatisch Farbenblind'             ),
(      'en',          17 , 'red-monochromatic (color-blind)'             ),
(      'fr',          17 , 'daltonien, daltonienne monochromatique ROUGE'),

(      'de',          18 , 'Grün-Monochromatisch Farbenblind'            ),
(      'en',          18 , 'green-monochromatic (color-blind)'           ),
(      'fr',          18 , 'daltonien, daltonienne monochromatique VERT' ),

(      'de',          19 , 'Blau-Monochromatisch Farbenblind'            ),
(      'en',          19 , 'blue-monochromatic (color-blind)'            ),
(      'fr',          19 , 'daltonien, daltonienne monochromatique BLEU' ),

(      'de',          20 , 'IPS (LCD) z. B. iPad'                        ),
(      'en',          20 , 'IPS (LCD) eg. iPad'                          ),
(      'fr',          20 , 'IPS (LCD) par ex. iPad'                      );


-- --------------------------------------------------------

CREATE TABLE `nomination` (
  `ID`          int        NOT NULL AUTO_INCREMENT
, `F_rgb`       int        NOT NULL
, `F_farbnamen` int        NOT NULL
, `F_netzhaut`  tinyint    NOT NULL
, `F_medium`    tinyint    NOT NULL
, `F_ipV4`      int        NOT NULL
, `Zeit`        datetime   DEFAULT NULL COMMENT '1.1.2000, falls vor neuer Version, welche die Zeit auch erfasst'
, `F_sprache`   varchar(3) NOT NULL
, PRIMARY KEY (`ID`)
, FOREIGN KEY (`F_rgb`      ) REFERENCES `rgb`       (`ID`)
, FOREIGN KEY (`F_farbnamen`) REFERENCES `farbnamen` (`ID`)
, FOREIGN KEY (`F_netzhaut` ) REFERENCES `netzhaut`  (`ID`)
, FOREIGN KEY (`F_medium`   ) REFERENCES `medium`    (`ID`)
, FOREIGN KEY (`F_ipV4`     ) REFERENCES `ipV4`      (`ID`)
) COMMENT='Ein Wahl durch einen Nutzer (1:n Beziehung zu den Farben)';

INSERT INTO `nomination`
(`ID`, `F_rgb`, `F_farbnamen`, `F_netzhaut`, `F_medium`, `F_ipV4`, `Zeit`               , `F_sprache`)
VALUES
(   1,       1,             1,            2,          1,        1, '2000-01-01 00:00:00', 'de'       ),
(   2,       2,             2,            2,          1,        2, '2000-01-01 00:00:00', 'de'       );

-- --------------------------------------------------------
