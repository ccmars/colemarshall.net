<?php
// Cole Class
namespace Marshall;

class Cole extends Human {
	const NAME_FIRST = "Cole";
	const NAME_LAST = "Marshall";
	private $profession;
	private $specialties;

	function __construct($initialProfession = "Interactive Developer & Designer") {
		$this->profession = $initialProfession;
		$this->specialties = [
			"HTML", "CSS", "JavaScript", "Sass", "jQuery",
			"cross-browser compatibility", "mobile/responsive design", "search engine optimization",
			"PHP", "MySQL", "REST", "XML", "JSON", "Git", "automation",
			"Photoshop", "Illustrator", "After Effects", "Graphic Design", "Typography",
			"User Interface (UI) Design", "User Experience (UX) Design", "Motion Graphics"
		];
	}

	public function getFullName() {
		return self::NAME_FIRST . ' ' . self::NAME_LAST;
	}

	public function getProfession() {
		return $this->profession;
	}

	public function setProfession($newProfession) {
		return $this->profession = $newProfession;
	}

	public function getSpecialties() {
		return $this->specialties;
	}

	public function setSpecialties($newSpecialties) {
		if (is_array($newSpecialties)) {
			return $this->specialties = $newSpecialties;
		} else {
			return false;
		}
	}

	public function getReadableDetails() {
		$readable = $this->getFullName() . " is " . (preg_match('/^[aeiou]/i',$this->getProfession())?"an ":"a ") . $this->getProfession() . " who specializes in ";
		for ($i = 0; $i < count($this->getSpecialties()); $i++) {
			$readable .= $this->getSpecialties()[$i];
			if ($i == count($this->getSpecialties()) - 2) {
				$readable .= (count($this->getSpecialties()) > 2?",":'') . " and ";
			} else if ($i == count($this->getSpecialties()) - 1) {
				$readable .= ".";
			} else {
				$readable .= ", ";
			}
		}
		return $readable;
	}
}

// Instantiate Cole
$cole = new \Marshall\Cole();

// Echo Cole's Profession and Specialties
echo $cole->getReadableDetails();
?>