// Cole Class
class Cole {
	#nameFirst = 'Cole';
	#nameLast = 'Marshall';
	#skills = [
		'Web Design',
		'Frontend Web Development',
		'Backend Web Development',
		'Cloud DevOps',
	];

	constructor(profession) {
		this.profession = profession;
	}

	get fullName() {
		return `${this.#nameFirst} ${this.#nameLast}`;
	}

	get readableDetails() {
		const article = /^[aeiou]/i.test(this.profession) ? 'an' : 'a';
		const skills = new Intl.ListFormat('en', { type: 'conjunction' }).format(this.#skills);
		return `${this.fullName} is ${article} ${this.profession} who specializes in ${skills}.`;
	}
}

// Instantiate Cole
const cole = new Cole('Web Developer & Designer');

// Echo Cole's profession and skills
console.log(cole.readableDetails);
