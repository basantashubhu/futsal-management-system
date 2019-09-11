/* 
    time in time out calc in 12 hours format
*/

var Intelligent = {
	calculateTime(start, end, operator = true) {
		if (start == "") {
			start = "0:00";
		} else if (start == "0:00") {
		} else {
			if (start.match(/\d{1,2}:\d{1,2}$/) === null) {
				start = "0:00";
			} else if (operator) {
				let [hour, min] = start.split(":");
				hour = Number(hour);
				if (hour < 6) {
					start = [12 + hour, min].join(":");
				}
			}
		}

		if (end == "") {
			end = "0:00";
		} else if (end == "0:00") {
		} else {
			if (end.match(/\d{1,2}:\d{1,2}$/) === null) {
				end = "0:00";
			} else if (operator) {
				let [startHour, startMin] = start.split(":");
				startHour = Number(startHour);
				if (startHour < 6) {
					startHour += 12;
				}

				let [endHour, endMin] = end.split(":");
				endHour = Number(endHour);
				if (endHour - startHour < 0 || (endHour < 6 && startHour >= 6))
					endHour += 12;

				end = [endHour, endMin].join(":");
			}
		}

		start = start.split(":");
		end = end.split(":");
		var end = parseInt(end[0]) * 60 + parseInt(end[1]);
		var start = parseInt(start[0]) * 60 + parseInt(start[1]);
		var diff = Math.abs(end - start);
		let hours = parseInt(diff / 60);
		return hours + ":" + (diff % 60 < 9 ? "0" + (diff % 60) : diff % 60);
		// return (hours < 9 ?"0"+hours : hours) + ":" + (diff%60 < 9 ? "0"+diff%60 : diff%60);
	},

	AI_time(start, end, operator = true) {

		if (start == "") {
			start = "0:00";
		} else if (start == "0:00") {
		} else {
			if (start.match(/\d{1,2}:\d{1,2}$/) === null) {
				start = "0:00";
			} else if (operator) {
				let [hour, min] = start.split(":");
				hour = Number(hour);
				const plusHour = this.time_in ? parseInt(this.time_in) >= 12 : false;
				if (hour < 6 || plusHour) {
					start = [12 + hour, min].join(":");
				}
			}
		}

		if (end == "") {
			end = "0:00";
		} else if (end == "0:00") {
		} else {
			if (end.match(/\d{1,2}:\d{1,2}$/) === null) {
				end = "0:00";
			} else if (operator) {
				let [startHour, startMin] = start.split(":");
				startHour = Number(startHour);
				const plusHour = this.time_in ? parseInt(this.time_in) >= 12 : false;
				if (startHour < 6 || plusHour) {
					startHour += 12;
				}

				let [endHour, endMin] = end.split(":");
				endHour = Number(endHour);
				if (endHour - startHour < 0 || (endHour < 6 && startHour >= 6))
					endHour += 12;

				end = [endHour, endMin].join(":");
			}
		}

		return [start, end];
	},

	checkTsIsValid(userTimeIn) {
		let errors;

		return userTimeOut => userBreakIn => userBreakOut => {

      if(!(userTimeOut && userTimeIn)) return []; 

			let [time_in, time_out] = this.AI_time(userTimeIn, userTimeOut);
			let [break_out, break_in] = this.AI_time.call({ time_in, time_out }, userBreakOut, userBreakIn);

			// console.log({ time_in, time_out, break_out, break_in });

			if (moment(time_in, "HH:mm:ss").isBefore(moment(time_out, "HH:mm:ss"))) {
				if (
					moment(break_out, "HH:mm:ss").isSameOrBefore(
						moment(break_in, "HH:mm:ss")
					)
				) {
					if (
						(moment(break_out, "HH:mm:ss").isBetween(
							moment(time_in, "HH:mm:ss"),
							moment(time_out, "HH:mm:ss")
						) &&
							moment(break_in, "HH:mm:ss").isBetween(
								moment(time_in, "HH:mm:ss"),
								moment(time_out, "HH:mm:ss")
							)) ||
						(break_in === "0:00" && break_out === "0:00")
					) {
						errors = []; // no errors
					} else {
						console.log("breakin breanout must be within timein timeout limit");
						errors = ["break_in", "break_out"];
					}
				} else {
					console.log("Breakout cannot be after break in");
					errors = ["break_out"];
				}
			} else {
				errors = ["time_out"];
			}

			return errors;
		};
	}
};
