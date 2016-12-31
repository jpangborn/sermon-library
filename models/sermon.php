<?php
	namespace SLK;

	use Page;
	use L;

	class SermonPage extends Page {
		public function passagesDescriptions() {
			$descriptions = array();
			foreach($this->passages()->toStructure() as $passage) {
				if($passage->startbook()->value() == $passage->endbook()->value()) {
					if($passage->startchapter()->value() == $passage->endchapter()->value()) {
						if($passage->startverse()->value() == $passage->endverse()->value()) {
							$description = 	l::get($passage->startbook()->value()) . ' ' . $passage->startchapter() . ':' . $passage->startverse();
						} else {
							$description = l::get($passage->startbook()->value()) . ' ' . $passage->startchapter() . ':' . $passage->startverse() . '-' . $passage->endverse();
						}
					} else {
						$description = l::get($passage->startbook()->value()) . ' ' . $passage->startchapter() . ':' . $passage->startverse();
						$description .= ' - ' . $passage->endchapter() . ':' . $passage->endverse();
					}
				} else {
					$description = l::get($passage->startbook()->value()) . ' ' . $passage->startchapter() . ':' . $passage->startverse();
					$description .= ' - ';
					$description .= l::get($passage->endbook()->value()) . ' ' . $passage->endchapter() . ':' . $passage->endverse();
				}

				$descriptions[] = $description;
			}

			return $descriptions;
		}

		public function passageText($passage, $params = array()) {
			$defaults = array(
				'key'														=> c::get('slk.esvapi.key', 'TEST'),
				'include-passage-references'	 	=> false,
				'include-footnotes'							=> false,
				'include-audio-link'						=> false
			);

			$options = array_merge($defaults, $params);

			$options['passage'] = $passage;

			$scripture = remote::get(c::get('slk.esvapi.url'), array('data' => $options));

			return $scripture;
		}
	}
?>
