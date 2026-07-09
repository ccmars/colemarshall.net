interface Human {
	readonly nameFirst: string;
	readonly nameLast: string;
}

type ExperienceLevel =
	| 'Intern'
	| 'Junior'
	| 'Mid-Level'
	| 'Senior'
	| 'Staff'
	| 'Principal'
	| 'Contract';

interface Engineer extends Human {
	readonly profession: `${ExperienceLevel} ${string}`;
	readonly specialties: readonly [string, ...string[]];
}

// Cole's specialties
const specialties = [
	'Web Design',
	'Frontend Web Development',
	'Backend Web Development',
	'Automated Testing',
	'Cloud DevOps',
] as const;

// Instantiate Cole
const cole = {
	nameFirst: 'Cole',
	nameLast: 'Marshall',
	profession: 'Senior Full-Stack Engineer & Designer',
	specialties,
} satisfies Engineer;

// Introduce an Engineer
function introduce({ nameFirst, nameLast, profession, specialties }: Engineer): string {
	const article = /^[aeiou]/i.test(profession) ? 'an' : 'a';
	const specialtyList = new Intl.ListFormat('en', { type: 'conjunction' }).format(specialties);

	return `${nameFirst} ${nameLast} is ${article} ${profession} who specializes in ${specialtyList}.`;
}

// Echo Cole's profession and specialties
console.log(introduce(cole));
