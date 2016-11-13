<?php

/*
 *  Arpabet-to-IPA - converting Arpabet to IPA.
 * 
 * @author		Waldeilson Eder dos Santos
 * @copyright 	Copyright (c) 2015 Waldeilson Eder dos Santos
 * @link			https://github.com/wwesantos/arpabet-to-ipa
 * @package     	arpabet-to-ipa
 *
 * The MIT License (MIT)
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace ArpabetToIPA;

/**
 * @author Manuel Giorgini
 *
 */
class App {
	/*
	 * Reference: https://en.wikipedia.org/wiki/Arpabet
	 *
	 * In Arpabet, every phoneme is represented by one or two capital letters.
	 * Digits are used as stress indicators and are placed at the end of the stressed syllabic vowel.
	 * Punctuation marks are used like in the written language, to represent intonation changes at the end of clauses and sentences.
	 * The stress values are:
	 * Value Description
	 * 0 No stress
	 * 1 Primary stress
	 * 2 Secondary stress
	 */

	private $stressTable = array (
		  1	=> 'ˈ'	// primary
		, 2	=> 'ˌ'	// secondary
	);
	
	private $convertionTable = array (
		/*
		  Vowels - Monophthongs
		  Arpabet	IPA		Word examples
		  AO		ɔ		off (AO1 F); fall (F AO1 L); frost (F R AO1 S T)
		  AA		ɑ		father (F AA1 DH ER), cot (K AA1 T)
		  IY		i		bee (B IY1); she (SH IY1)
		  UW		u		you (Y UW1); new (N UW1); food (F UW1 D)
		  EH		ɛ OR e 	ed (R EH1 D); men (M EH1 N)
		  IH		ɪ		big (B IH1 G); win (W IH1 N)
		  UH		ʊ		should (SH UH1 D), could (K UH1 D)
		  AH		ʌ		but (B AH1 T), sun (S AH1 N)
		  AH(AH0) ə		sofa (S OW1 F AH0), alone (AH0 L OW1 N)
		  AE		æ		at (AE1 T); fast (F AE1 S T)
		  AX		ə 		discus (D IH1 S K AX0 S);
		 */
		  'AO'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɔ' )
		, 'AO0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɔ' )
		, 'AO1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɔ' )
		, 'AO2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɔ' )
		, 'AA'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɑ' )
		, 'AA0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɑ' )
		, 'AA1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɑ' )
		, 'AA2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɑ' )
		, 'IY'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'i' )
		, 'IY0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'i' )
		, 'IY1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'i' )
		, 'IY2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'i' )
		, 'UW'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'u' )
		, 'UW0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'u' )
		, 'UW1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'u' )
		, 'UW2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'u' )
		, 'EH'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɛ' )
		, 'EH0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɛ' )
		, 'EH1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɛ' )
		, 'EH2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɛ' )
		, 'IH'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɪ' )
		, 'IH0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɪ' )
		, 'IH1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɪ' )
		, 'IH2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ɪ' )
		, 'UH'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ʊ' )
		, 'UH0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ʊ' )
		, 'UH1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ʊ' )
		, 'UH2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ʊ' )
		, 'AH'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ʌ' )
		, 'AH0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ə' )
		, 'AH1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ʌ' )
		, 'AH2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ʌ' )
		, 'AE'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'æ' )
		, 'AE0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'æ' )
		, 'AE1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'æ' )
		, 'AE2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'æ' )
		, 'AX'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ə' )
		, 'AX0'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ə' )
		, 'AX1'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ə' )
		, 'AX2'	=> array ( 'type' => 'vowel' , 'category' => 'monophtong' , 'phoneme' => 'ə' )
		/*
		  Vowels - Diphthongs
		  Arpabet	IPA	Word Examples
		  EY		eɪ	say (S EY1); eight (EY1 T)
		  AY		aɪ	my (M AY1); why (W AY1); ride (R AY1 D)
		  OW		oʊ	show (SH OW1); coat (K OW1 T)
		  AW		aʊ	how (HH AW1); now (N AW1)
		  OY		ɔɪ	boy (B OY1); toy (T OY1)
		 */
		, 'EY'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'eɪ' )
		, 'EY0'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'eɪ' )
		, 'EY1'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'eɪ' )
		, 'EY2'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'eɪ' )
		, 'AY'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'aɪ' )
		, 'AY0'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'aɪ' )
		, 'AY1'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'aɪ' )
		, 'AY2'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'aɪ' )
		, 'OW'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'oʊ' )
		, 'OW0'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'oʊ' )
		, 'OW1'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'oʊ' )
		, 'OW2'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'oʊ' )
		, 'AW'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'aʊ' )
		, 'AW0'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'aʊ' )
		, 'AW1'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'aʊ' )
		, 'AW2'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'aʊ' )
		, 'OY'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'ɔɪ' )
		, 'OY0'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'ɔɪ' )
		, 'OY1'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'ɔɪ' )
		, 'OY2'	=> array ( 'type' => 'vowel' , 'category' => 'diphthong' , 'phoneme' => 'ɔɪ' )
		/*
		  Consonants - Stops
		  Arpabet	IPA	Word Examples
		  P		p	pay (P EY1)
		  B		b	buy (B AY1)
		  T		t	take (T EY1 K)
		  D		d	day (D EY1)
		  K		k	key (K IY1)
		  G		ɡ	go (G OW1)
		 */
		, 'P'	=> array ( 'type' => 'consonant' , 'category' => 'stop' , 'phoneme' => 'p' )
		, 'B'	=> array ( 'type' => 'consonant' , 'category' => 'stop' , 'phoneme' => 'b' )
		, 'T'	=> array ( 'type' => 'consonant' , 'category' => 'stop' , 'phoneme' => 't' )
		, 'D'	=> array ( 'type' => 'consonant' , 'category' => 'stop' , 'phoneme' => 'd' )
		, 'K'	=> array ( 'type' => 'consonant' , 'category' => 'stop' , 'phoneme' => 'k' )
		, 'G'	=> array ( 'type' => 'consonant' , 'category' => 'stop' , 'phoneme' => 'g' )
		/*
		  Consonants - Affricates
		  Arpabet	IPA	Word Examples
		  CH		tʃ	chair (CH EH1 R)
		  JH		dʒ	just (JH AH1 S T); gym (JH IH1 M)
		 */
		, 'CH'	=> array ( 'type' => 'consonant' , 'category' => 'affricate' , 'phoneme' => 'tʃ' )
		, 'JH'	=> array ( 'type' => 'consonant' , 'category' => 'affricate' , 'phoneme' => 'dʒ' )
		/*
		  Consonants - Fricatives
		  Arpabet	IPA	Word Examples
		  F		f	for (F AO1 R)
		  V		v	very (V EH1 R IY0)
		  TH		θ	thanks (TH AE1 NG K S); Thursday (TH ER1 Z D EY2)
		  DH		ð	that (DH AE1 T); the (DH AH0); them (DH EH1 M)
		  S		s	say (S EY1)
		  Z		z	zoo (Z UW1)
		  SH		ʃ	show (SH OW1)
		  ZH		ʒ	measure (M EH1 ZH ER0); pleasure (P L EH1 ZH ER)
		  HH		h	house (HH AW1 S)
		 */
		, 'F'	=> array ( 'type' => 'consonant' , 'category' => 'fricative' , 'phoneme' => 'f' )
		, 'V'	=> array ( 'type' => 'consonant' , 'category' => 'fricative' , 'phoneme' => 'v' )
		, 'TH'	=> array ( 'type' => 'consonant' , 'category' => 'fricative' , 'phoneme' => 'θ' )
		, 'DH'	=> array ( 'type' => 'consonant' , 'category' => 'fricative' , 'phoneme' => 'ð' )
		, 'S'	=> array ( 'type' => 'consonant' , 'category' => 'fricative' , 'phoneme' => 's' )
		, 'Z'	=> array ( 'type' => 'consonant' , 'category' => 'fricative' , 'phoneme' => 'z' )
		, 'SH'	=> array ( 'type' => 'consonant' , 'category' => 'fricative' , 'phoneme' => 'ʃ' )
		, 'ZH'	=> array ( 'type' => 'consonant' , 'category' => 'fricative' , 'phoneme' => 'ʒ' )
		, 'HH'	=> array ( 'type' => 'consonant' , 'category' => 'fricative' , 'phoneme' => 'h' )
		/*
		  Consonants - Nasals
		  Arpabet	IPA	Word Examples
		  M		m	man (M AE1 N)
		  N		n	no (N OW1)
		  NG		ŋ	sing (S IH1 NG)
		 */
		, 'M'	=> array ( 'type' => 'consonant' , 'category' => 'nasal' , 'phoneme' => 'm' )
		, 'N'	=> array ( 'type' => 'consonant' , 'category' => 'nasal' , 'phoneme' => 'n' )
		, 'NG'	=> array ( 'type' => 'consonant' , 'category' => 'nasal' , 'phoneme' => 'ŋ' )
		/*
		  Consonants - Liquids
		  Arpabet	IPA		Word Examples
		  L		ɫ OR l	late (L EY1 T)
		  R		r OR ɹ	run (R AH1 N)
		 */
		, 'L' => array ( 'type' => 'consonant' , 'category' => 'liquid' , 'phoneme' => 'l' )
		, 'R' => array ( 'type' => 'consonant' , 'category' => 'liquid' , 'phoneme' => 'r' )
		/*
		  Vowels - R-colored vowels
		  Arpabet			IPA	Word Examples
		  ER				ɝ	her (HH ER0); bird (B ER1 D); hurt (HH ER1 T), nurse (N ER1 S)
		  AXR				ɚ	father (F AA1 DH ER); coward (K AW1 ER D)
		  The following R-colored vowels are contemplated above
		  EH R			ɛr	air (EH1 R); where (W EH1 R); hair (HH EH1 R)
		  UH R			ʊr	cure (K Y UH1 R); bureau (B Y UH1 R OW0), detour (D IH0 T UH1 R)
		  AO R			ɔr	more (M AO1 R); bored (B AO1 R D); chord (K AO1 R D)
		  AA R			ɑr	large (L AA1 R JH); hard (HH AA1 R D)
		  IH R or IY R	ɪr	ear (IY1 R); near (N IH1 R)
		  AW R			aʊr	This seems to be a rarely used r-controlled vowel. In some dialects flower (F L AW1 R; in other dialects F L AW1 ER0)
		 */
		, 'ER'		=> array ( 'type' => 'vowel' , 'category' => 'r-colored vowel' , 'phoneme' => 'ɜr' )
		, 'ER0'		=> array ( 'type' => 'vowel' , 'category' => 'r-colored vowel' , 'phoneme' => 'ɜr' )
		, 'ER1'		=> array ( 'type' => 'vowel' , 'category' => 'r-colored vowel' , 'phoneme' => 'ɜr' )
		, 'ER2'		=> array ( 'type' => 'vowel' , 'category' => 'r-colored vowel' , 'phoneme' => 'ɜr' )
		, 'AXR'		=> array ( 'type' => 'vowel' , 'category' => 'r-colored vowel' , 'phoneme' => 'ər' )
		, 'AXR0'	=> array ( 'type' => 'vowel' , 'category' => 'r-colored vowel' , 'phoneme' => 'ər' )
		, 'AXR1'	=> array ( 'type' => 'vowel' , 'category' => 'r-colored vowel' , 'phoneme' => 'ər' )
		, 'AXR2'	=> array ( 'type' => 'vowel' , 'category' => 'r-colored vowel' , 'phoneme' => 'ər' )
		/*
		  Consonants - Semivowels
		  Arpabet	IPA	Word Examples
		  Y		j	yes (Y EH1 S)
		  W		w	way (W EY1)
		 */
		, 'W'	=> array ( 'type' => 'consonant' , 'category' => 'semivowel' , 'phoneme' => 'w' )
		, 'Y'	=> array ( 'type' => 'consonant' , 'category' => 'semivowel' , 'phoneme' => 'j' )
	);

	public function __construct () {
		
	}

	/**
	 * Use this method if you want to set a personilized convertion table
	 * @param $convertionTable = array(key=>value) 
	 * @throws \InvalidArgumentException Arpabet-to-IPA::invalid convertionTable
	 */
	public function setConvertionTable ( $convertionTable ) {
		if (
				isset ( $convertionTable ) &&
				!empty ( $convertionTable ) &&
				is_array ( $convertionTable ) &&
				$this -> is_assoc ( $convertionTable )
		) {
			$this -> convertionTable = $convertionTable;
		} else {
			throw new \InvalidArgumentException ( 'Arpabet-to-IPA::invalid convertionTable' );
		}
	}

	/**
	 * It converts Arpabet to IPA, you can pass either a phoneme, or a string with many phonemes separated by space
	 * @param string $arpabetArg
	 * @throws \InvalidArgumentException Arpabet-to-IPA::arpabet phoneme cannot be null
	 * @throws \InvalidArgumentException Arpabet-to-IPA::phoneme "{arpabetPhoneme}" was not found
	 * @return Ambigous <string, NULL, multitype:string >
	 */
	public function getIPA ( $arpabetArg = '' ) {
		$arpabet = trim ( $arpabetArg );
		$ipaWord = '';

		if ( empty ( $arpabet ) ) {
			throw new \InvalidArgumentException ( 'Arpabet-to-IPA::arpabet phoneme cannot be null' );
		}

		$aArpabet = preg_split ( '/[\s]+/' , $arpabet );
		$aIpa = array();
		foreach ( $aArpabet as $arpabetPhoneme ) {
			$phoneme = $this -> getIpaPhoneme ( $arpabetPhoneme );
			if ( isset ( $phoneme ) ) {
				$aIpa[] = $phoneme;
			} else {
				throw new \InvalidArgumentException ( 'Arpabet-to-IPA::phoneme "' . $arpabetPhoneme . '" was not found' );
			}
		}

		$nVowels = 0;
		$nPreviousConsonant = -1;
		$aStressFound = array ( 1 => -1 , 2 => -1 );
		for ( $i = 0 ; $i < count ( $aIpa ) ; $i++ ) {
			if ( $aIpa["$i"]['type'] === 'vowel' ) {
				$nVowels++;
			} else {
				$nPreviousConsonant = $i;
			}
			$stress = intval ( substr ( $aArpabet["$i"] , -1 , 1 ) );
			if ( $stress !== 0 ) {
				$aStressFound["$stress"] = $i;
				$nPhonemeToBeChanged = $i;
				if ( $nVowels === 1 ) {
					$nPhonemeToBeChanged = 0;
				} else {
					if ( $nPreviousConsonant !== -1 ) {
						$nPhonemeToBeChanged = $nPreviousConsonant;
					}
				}
				$aIpa["$nPhonemeToBeChanged"]['phoneme'] = $this -> stressTable["$stress"] . $aIpa["$nPhonemeToBeChanged"]['phoneme'];
			}
		}
		
		for ( $i = 0 ; $i < count ( $aIpa ) ; $i++ ) {
			$ipaWord .= $aIpa["$i"]['phoneme'];
		}
		return $ipaWord;
	}

	/**
	 * @param unknown $arpabetPhoneme
	 * @return multitype:string |NULL
	 */
	private function getIpaPhoneme ( $arpabetPhoneme ) {

		if ( array_key_exists ( $arpabetPhoneme , $this -> convertionTable ) ) {
			return $this -> convertionTable["$arpabetPhoneme"];
		} else {
			return NULL;
		}
	}

	/**
	 * @param unknown $arr
	 * @return boolean
	 */
	private function is_assoc ( $arr ) {
		return array_keys ( $arr ) !== range ( 0 , count ( $arr ) - 1 );
	}

}
