// Cole Class
var Cole = function(initialProfession) {
	this.nameFirst = "Cole";
	this.nameLast = "Marshall";
	this.profession = initialProfession;
	this.skills = [
		"Frontend Web Development",
		"Backend Web Development",
		"Web Design"
	];
}

Cole.prototype.getFullName = function() {
	return this.nameFirst + ' ' + this.nameLast;
};

Cole.prototype.getReadableDetails = function() {
	var readable = this.getFullName() + " is " + (this.profession.match('/^[aeiou]/i')?"an ":"a ") + this.profession + " who specializes in ";
	for (var i = 0; i < this.skills.length; i++) {
		readable += this.skills[i];
		if (i == this.skills.length - 2) {
			readable += (this.skills.length > 2?",":'') + " and ";
		} else if (i == this.skills.length - 1) {
			readable += ".";
		} else {
			readable += ", ";
		}
	}
	return readable;
}

// Instantiate Cole
var cole = new Cole("Web Developer & Designer");

// Echo Cole's Profession and Skills
console.log(cole.getReadableDetails());