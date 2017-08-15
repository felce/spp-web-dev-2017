var ATM = {
    is_auth: false, 
    current_user:false,
    current_type:false,

     
    // all cash of ATM
    cash: 2000,
    // all available users
    users: [
        {number: "0000", pin: "000", debet: 0, type: "admin"}, // EXTENDED
        {number: "0025", pin: "123", debet: 675, type: "user"}
    ],
    report: [],
    // authorization
    auth: function(number, pin) {
        var arr = this.users;
        for (var i = 0; i < arr.length; i++){
            if (arr[i]['number'] == number && arr[i]['pin'] == pin){
                this.is_auth = true;
                console.log("welcome to ATM");
                this.current_user = i;
                if (arr[i]['type'] == "admin"){
                    this.current_type = true;
                }
                break;
            }
        }
    },
    // check current debet
    check: function() {
        var current_user_debet = this.users[+this.current_user]['debet'];
        if (this.is_auth) {
            console.log("your debet is ", current_user_debet);

        } else {
            console.log("auth, please");
        }
    },
    // get cash - available for user only
    getCash: function(amount) {
        var current_user_debet = this.users[+this.current_user]['debet'];
        if (this.is_auth && !this.current_type) {
            if (amount <= current_user_debet && amount <= this.cash) {
                this.users[+this.current_user]['debet'] -= amount;
                this.cash -= amount;
                current_user_debet = this.users[+this.current_user]['debet'];
                console.log("your debet is ", current_user_debet);
                this.report.push("user " + this.users[+this.current_user]['number'] + " get cash " + amount);
            } else {
                console.log("no money:)");
            }
        } else {
            console.log("auth, please");
        }
    },
    // load cash - available for user only
    loadCash: function(amount){
        if (this.is_auth && !this.current_type) {
            this.users[+this.current_user]['debet'] += amount;
                this.cash += amount;
                current_user_debet = this.users[+this.current_user]['debet'];
                console.log("your debet is ", current_user_debet);
                this.report.push("user " + this.users[+this.current_user]['number'] + " load cash " + amount);
        } else {
            console.log("auth, please");
        }
    },
    // load cash to ATM - available for admin only - EXTENDED
    load_cash: function(addition) {
        if (this.is_auth && this.current_type) {
                this.cash += addition;
                this.report.push("admin " + this.users[+this.current_user]['number'] + " load cash " + addition);
        } else {
            console.log("auth, please");
        }
    },
    // get report about cash actions - available for admin only - EXTENDED
    getReport: function() {
        if (this.is_auth && this.current_type) {
            for (var i = 0; i < this.report.length; i++) {
                console.log(this.report[i]);
            }
        } else {
            console.log("auth, please");
        }
    },
    // log out
    logout: function() {
        if (this.is_auth) {
            this.is_auth = false;
            console.log("Gud Buy!");
        } else {
            console.log("auth, please");
        }
    }
};