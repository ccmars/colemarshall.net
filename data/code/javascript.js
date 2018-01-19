// Cole Class
class Cole {
	constructor(initialProfession) {
		this.nameFirst = "Cole";
		this.nameLast = "Marshall";
		this.profession = initialProfession;
		this.skills = [
			"Frontend Web Development",
			"Backend Web Development",
			"Web Design"
		];
	}

	getFullName() {
		return this.nameFirst + ' ' + this.nameLast;
	}

	getReadableDetails() {
		let readable = this.getFullName() + " is " + (this.profession.match(/^[aeiou]/i)?"an ":"a ") + this.profession + " who specializes in ";
		for (let i = 0; i < this.skills.length; i++) {
			readable += this.skills[i];
			if (i === this.skills.length - 2) {
				readable += (this.skills.length > 2?",":'') + " and ";
			} else if (i === this.skills.length - 1) {
				readable += ".";
			} else {
				readable += ", ";
			}
		}
		return readable;
	}
}

// Instantiate Cole
let cole = new Cole("Interactive Developer & Designer");

// Echo Cole's Profession and Skills
console.log(cole.getReadableDetails());