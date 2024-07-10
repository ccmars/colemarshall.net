<?php
// Cole Class
namespace Marshall;

class Cole extends Human {
	const NAME_FIRST = "Cole";
	const NAME_LAST = "Marshall";
	private string $profession;
	private array $specialties;

	function __construct(string $initialProfession = "Web Developer & Designer") {
		$this->profession = $initialProfession;
		$this->specialties = [
			"HTML", "CSS", "Sass", "JavaScript", "TypeScript", "Vue.js", "jQuery",
			"cross-browser compatibility", "mobile/responsive design", "search engine optimization",
			"PHP", "Node.js", "MySQL", "REST", "XML", "JSON", "Git",
			"automation", "API development", "cloud DevOps", "IaC (Infrastructure as Code)", "unit testing",
			"Photoshop", "Illustrator", "After Effects", "Graphic Design", "Typography",
			"User Interface (UI) Design", "User Experience (UX) Design", "Motion Graphics"
		];
	}

	public function getFullName():string {
		return self::NAME_FIRST . ' ' . self::NAME_LAST;
	}

	public function getProfession():string {
		return $this->profession;
	}

	public function setProfession(string $newProfession):string {
		return $this->profession = $newProfession;
	}

	public function getSpecialties():array {
		return $this->specialties;
	}

	public function setSpecialties(array $newSpecialties):array {
		return $this->specialties = $newSpecialties;
	}

	public function getReadableDetails():string {
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