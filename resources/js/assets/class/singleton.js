// First example
export default class Singleton {
	number = 0;
	constructor() {
		if (!!Singleton.instance) {
			return Singleton.instance;
		}
		Singleton.instance = this;
		// return this;
	}
	setCounter(number) {
		this.number = number;
	}
}

// Second example
// let instance;
// export default class Singleton {
// 	constructor() {
// 		if (instance) {
// 			return instance;
// 			// throw new Error('You can only create one instance!');
// 		}
// 		instance = this;
// 	}
// 	setCounter(number) {
// 		this.number = number;
// 	}
// }

// let notEditable = Object.freeze(new Singleton());
// let instanceOne = new Singleton();
// let instanceTwo = new Singleton();
// instanceTwo.setCounter(5);
// instanceTwo.setCounter(6);
// console.log('Singleton:', instanceOne, instanceTwo); // Logs "true"
// console.log('Singleton:', instanceOne === instanceTwo); // Logs "true"
