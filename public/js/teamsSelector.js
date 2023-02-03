window.addEventListener("load", function() {
    const team1Select = document.getElementById("team1_id");
    const team2Select = document.getElementById("team2_id");
    const submitButton = document.getElementById("submit");

    team1Select.addEventListener("change", function() {
        //console.log("team 1 selected");
        for (let i = 1; i < team2Select.options.length; i++) {
            if (team2Select.options[i].value === this.value) {
                team2Select.options[i].setAttribute("disabled", "disabled");
                //console.log("team 2 option disabled");
            } else {
                team2Select.options[i].removeAttribute("disabled");
                //console.log("team 2 option enabled");
            }
        }
        if (team1Select.value === team2Select.value) {
            submitButton.setAttribute("disabled", "disabled");
        } else {
            submitButton.removeAttribute("disabled");
        }
    });

    team2Select.addEventListener("change", function() {
        //console.log("team 2 selected");
        for (let i = 1; i < team1Select.options.length; i++) {
            if (team1Select.options[i].value === this.value) {
                team1Select.options[i].setAttribute("disabled", "disabled");
                //console.log("team 1 option disabled");
            } else {
                team1Select.options[i].removeAttribute("disabled");
                //console.log("team 1 option enabled");
            }
        }
        if (team1Select.value === team2Select.value) {
            submitButton.setAttribute("disabled", "disabled");
        } else {
            submitButton.removeAttribute("disabled");
        }
    });
});
