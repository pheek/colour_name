-- ----------------------------
-- Create database and default data for "www.colour.name".
-- 2018-12-01 phi@gress.ly
--

USE               `farbnamen` ;
SET NAMES         'utf8'      ;
SET CHARACTER SET 'utf8'      ;


INSERT INTO `farbnamen`
(`ID`,`Name`      ) VALUES
(   1, 'rot'      ),
(   2, 'grün'     ),
(   3, 'blau'     ),
(   4, 'gelb'     ),
(   5, 'zyan'     ),
(   6, 'fuchsia'  ),
(   7, 'weiß'     ),
(   8, 'grau'     ),
(   9, 'schwarz'  ),

(  10, 'red'      ),
(  11, 'green'    ),
(  12, 'blue'     ),
(  13, 'yellow'   ),
(  14, 'cyan'     ),
(  15, 'magenta'  ),
(  16, 'white'    ),
(  17, 'grey'     ),
(  18, 'black'    ),

(  19, 'rouge'    ),
(  20, 'vert'     ),
(  21, 'bleu'     ),
(  22, 'jaune'    ),
(  23, 'cyanogène'),
(  24, 'magenta'  ),
(  25, 'blanc'    ),
(  26, 'gris'     ),
(  27, 'noir'     );


INSERT INTO `ipV4`
(`ID`, `v4Int`   ) VALUES
(  1 , 1426219562),
(  2 , 1414157270),
(  3 , 1234567890);

INSERT INTO `rgb`
(`ID`,  `R`,   `G`,  `B`) VALUES
(  1 , 255 ,    0 ,   0 ),
(  2 ,   0 ,  255 ,   0 ),
(  3 ,   0 ,    0 , 255 );


INSERT INTO `nomination`
(`ID`, `F_rgb`, `F_farbnamen`, `F_netzhaut`, `F_medium`, `F_ipV4`, `Zeit`               , `F_sprache`)
VALUES
(   1,       1,             1,            2,          1,        1, '2018-12-14 00:00:00', 'de'       ),
(   2,       2,             2,            2,          1,        2, '2012-12-14 00:00:00', 'de'       ),
(   3,       3,             3,            2,          1,        3, '2012-12-14 00:00:00', 'de'       );

-- --------------------------------------------------------
