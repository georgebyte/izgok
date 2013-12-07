<?php

class QuestionsTableSeeder extends Seeder {

    public function run()
    {
		Question::create(array('question' => 'Katera ozemlja so Rimljani dobili po prvi punski vojni?', 'answer_1' => 'Sardinijo, Korziko, Monako', 'answer_2' => 'Siciljo, Korziko', 'answer_3' => 'Sicilijo, Sardinijo', 'answer_correct' => 'Sicilijo, Korziko, Sardinijo'));
		Question::create(array('question' => 'Kako so se imenovali predstavniki plebejcev v rimskem senatu, v začetnem obdobju republike?', 'answer_1' => 'Republikanci', 'answer_2' => 'Oligarhi', 'answer_3' => 'Patriciji', 'answer_correct' => 'Ljudski tribuni'));
		Question::create(array('question' => 'Kdaj se je zgodil prvi znani vpad Hunov v Evropo?', 'answer_1' => '346', 'answer_2' => '427', 'answer_3' => '304', 'answer_correct' => '375'));
		Question::create(array('question' => 'Katerega leta so izumrli zahodni Karolingi ?', 'answer_1' => '879', 'answer_2' => '928', 'answer_3' => '897', 'answer_correct' => '987'));
		Question::create(array('question' => 'Katera dinastija nasledi zahodne Karolinge ?', 'answer_1' => 'Vizigoti', 'answer_2' => 'Franki', 'answer_3' => 'Salijska dinastija', 'answer_correct' => 'Kapetingi'));
		Question::create(array('question' => 'Kaj je obdobje interregnuma ?', 'answer_1' => 'Obdobje večvladja.', 'answer_2' => 'Obdobje ko vlada dinastija.', 'answer_3' => 'Obdobje fevdalizma.', 'answer_correct' => 'Obdobje brezvladja.'));
		Question::create(array('question' => 'Kaj je rekonkvista?', 'answer_1' => 'Rekonstruiranje  srednjega meščanskega razreda.', 'answer_2' => 'Obdobje dinastije poimenovano po Aragonu Reconquisti.', 'answer_3' => 'Osvojitev Pirenejskega polotoka s strani Arabcev.', 'answer_correct' => 'Osvojitev Pirenejskega polotoka s strani Špancev.'));
		Question::create(array('question' => 'Po kom je poimenovan Gregorijanski koledar ?', 'answer_1' => 'Po Papežu Gregorju XI.', 'answer_2' => 'Po Papežu Gregoriju XI.', 'answer_3' => 'Po Papežu Gregorjanu XIV.', 'answer_correct' => 'Po Papežu Gregorju XIII.'));
		Question::create(array('question' => 'V katerem obdobju je vladal Papež Gregor XIII ?', 'answer_1' => '1558-1572', 'answer_2' => '1585-1592', 'answer_3' => '1572-1588', 'answer_correct' => '1572-1585'));
		Question::create(array('question' => 'V čem se despot razlikuje od absolutista ?', 'answer_1' => 'Absolutist se ima za boga.', 'answer_2' => 'Despot ima samo zakonodajno oblast.', 'answer_3' => 'Absolutist ne nadzira cerkve.', 'answer_correct' => 'Despot se ima za boga.'));
		Question::create(array('question' => 'V katerem obdobju je bila uvedena gospodarska politika imenovana "Merkantilizem" ?', 'answer_1' => 'V času Bizantintskega cesarstva.', 'answer_2' => 'V času Rimskega Imperija.', 'answer_3' => 'V obdobju fevdalizma.', 'answer_correct' => 'V obdobju absolutizma.'));
		Question::create(array('question' => 'Kateri absolutist je imel vzdevek Sončni Kralj ?', 'answer_1' => 'Ludvik XIII', 'answer_2' => 'Ludvik XVI', 'answer_3' => 'Ludvik XV.', 'answer_correct' => 'Ludvik XIV.'));
		Question::create(array('question' => 'Kje se je začela Renesansa?', 'answer_1' => 'V Parizu.', 'answer_2' => 'V Benetkah.', 'answer_3' => 'V Vatikanu.', 'answer_correct' => 'V Firencah.'));
		Question::create(array('question' => 'V katerem obdobju je bil zgrajen Veliki Kitajski zid ?', 'answer_1' => 'V obdobju med 12. in 14. stoletjem.', 'answer_2' => 'V obdobju med 13. in 16. stoletjem.', 'answer_3' => 'V obdobju med 11. in 14. stoletjem.', 'answer_correct' => 'V obdobju med 14. in 17. stoletjem.'));
		Question::create(array('question' => 'V katerem obdobju je hune vodil Attila ?', 'answer_1' => '424 - 432', 'answer_2' => '427 - 431', 'answer_3' => '414 - 433', 'answer_correct' => '434 - 453'));
		Question::create(array('question' => 'V katerem obdobju je bil srednji vek ?', 'answer_1' => '442 - 1450', 'answer_2' => '442 - 1492', 'answer_3' => '476 - 1497', 'answer_correct' => '476 - 1492'));
		Question::create(array('question' => 'Katerega leta začne Mohamed širiti svojo vero ?', 'answer_1' => '613', 'answer_2' => '442', 'answer_3' => '768', 'answer_correct' => '622'));
		Question::create(array('question' => 'V katerem odbobju se je zgodil monglski vpad v srednjo Evropo ?', 'answer_1' => '1239 - 1240', 'answer_2' => '1237 - 1239', 'answer_3' => '1235 - 1236', 'answer_correct' => '1241 - 1242'));
		Question::create(array('question' => 'Katerega leta je bila ustanovljena Verdunska pogodba ?', 'answer_1' => '800', 'answer_2' => '840', 'answer_3' => '838', 'answer_correct' => '843'));
		Question::create(array('question' => 'Iz kje izvirajo samuraji ?', 'answer_1' => 'Kitajske', 'answer_2' => 'Mongolije', 'answer_3' => 'Koreje', 'answer_correct' => 'Japonske'));
		Question::create(array('question' => 'V katerem obdobju se je odvijala Ameriška vojna za neodvistnost (ang: American War of Independence) ?', 'answer_1' => '1773 – 1775', 'answer_2' => '1766 – 1773', 'answer_3' => '1783 – 187', 'answer_correct' => '1775 – 1783'));    	
    }

}