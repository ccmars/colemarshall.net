<?php
// Cole Class
namespace Marshall;

class Cole extends Human {
	final public const string NAME_FIRST = 'Cole';
	final public const string NAME_LAST = 'Marshall';

	public string $fullName {
		get => self::NAME_FIRST . ' ' . self::NAME_LAST;
	}

	public function __construct(
		public private(set) string $profession = 'Web Developer & Designer',
		public private(set) array $specialties = [
			'HTML', 'CSS', 'JavaScript', 'TypeScript', 'Vue.js',
			'cross-browser compatibility', 'mobile/responsive design', 'search engine optimization',
			'PHP', 'Node.js', 'MySQL', 'REST', 'XML', 'JSON', 'Git', 'automation',
			'API development', 'cloud DevOps', 'IaC (Infrastructure as Code)', 'unit testing', 'end-to-end testing',
			'Photoshop', 'Illustrator', 'After Effects', 'Graphic Design', 'Typography',
			'User Interface (UI) Design', 'User Experience (UX) Design', 'Motion Graphics',
		],
	) {}

	public function getReadableDetails(): string {
		$specialties = $this->specialties;
		$finalSpecialty = array_pop($specialties);
		$article = preg_match('/^[aeiou]/i', $this->profession) ? 'an' : 'a';

		return sprintf(
			'%s is %s %s who specializes in %s, and %s.',
			$this->fullName,
			$article,
			$this->profession,
			implode(', ', $specialties),
			$finalSpecialty,
		);
	}
}

// Instantiate Cole
$cole = new Cole();

// Echo Cole's profession and specialties
echo $cole->getReadableDetails();
