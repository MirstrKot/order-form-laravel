new Vue({
	el: '#app',
	data: {
		plans: [],
		formData: {
			plan_id: 0
		},
		isLoaded: false,
		isSubmiting: false,
		submitErrors: null,
		isCriticalError: false,
		daysOfWeek: {
			0: "воскресеньям",
			1: "понедельникам",
			2: "вторникам",
			3: "средам",
			4: "четвергам",
			5: "пятницам",
			6: "субботам"
		},
		successData: null
	},
	computed: {
		disabledDates: function () {
			return {
				days: this.disabledDays,
				to: new Date()
			}
		},
		disabledDays: function () {
			for (let index in this.plans) {
				if (this.plans.hasOwnProperty(index)) {
					if (this.plans[index].id === this.formData.plan_id) {
						let all_days = [0, 1, 2, 3, 4, 5, 6];
						let available_days = this.plans[index].days_array;
						return all_days.filter(function (i) {
							return available_days.indexOf(i) < 0;
						});
					}
				}
			}
			return [];
		}
	},
	methods: {
		sendRequest: function () {
			if (!this.validate()) return;
			this.isSubmiting = true;
			this.isCriticalError = false;
			axios.post('/api/order', this.formData)
				.then(function (response) {
					this.isSubmiting = false;
					this.successData = response.data;
				}.bind(this))
				.catch(function (error) {
					console.log(error);
					if (error.response.status == 422) {
						this.submitErrors = error.response.data.errors;
					}
					else {
						this.isCriticalError = true;
					}
					this.isSubmiting = false;
				}.bind(this));
		},
		validate: function() {
			this.submitErrors = {};
			var required = ["name", "phone", "plan_id", "date", "address"];
			for (let index in required) {
				if (required.hasOwnProperty(index)) {
					var key = required[index];
					if (!this.formData[key]) this.submitErrors[key] = "required";
				}
			}
			if (this.formData && this.formData["phone"] && this.formData['phone'].length !== 10) {
				this.submitErrors["phone"] = "wrong length";
			}
			if (!Object.keys(this.submitErrors).length) this.submitErrors = null;
			return !this.submitErrors;
		},
		clearSubmitError: function (event) {
			if (this.submitErrors !== null) {
				this.removeSubmitError(event.target.name);
			}
		},
		clearSubmitMaskedError: function () {
			if (this.submitErrors !== null) {
				this.removeSubmitError('phone');
			}
		},
		clearSubmitDatepickerError: function () {
			if (this.submitErrors !== null) {
				this.removeSubmitError('date');
			}
		},
		removeSubmitError(name) {
			if (this.submitErrors.hasOwnProperty(name)) {
				delete this.submitErrors[name];
			}
		},
		//для получения значения после выбора в Google Places Api
		addressChanged: function (event) {
			this.formData.address = event.target.value;
		}
	},
	components: {
		vuejsDatepicker
	},
	created: function () {
		axios.get('/api/plan/list')
			.then(function (response) {
				this.plans = response.data;
				this.isLoaded = true
			}.bind(this))
			.catch(function (error) {
				console.log(error);
			});
	}
});