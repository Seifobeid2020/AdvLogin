 let sock = new WebSocket("ws://localhost:5001"); console.log(sock); sock.onopen = function() {     sock.send(JSON.stringify({         type:"login",         user_name: user_name_login,         user_ID: user_id_login,         session_ID: session_id_login,         Login_date: "123442",         Login_time: "yes",         user_IP: ip_login     })); }; sock.onmessage= function (event) {     let json = JSON.parse(event.data);     if(json.type =="forse_logout"){         window.location.assign("logout.php");     }     console.log(json); };function session_timeout( ) { //user_name ,user_id,session_id,ip    console.log("h11");    // sock.send(JSON.stringify({    //     type:"session_timeout",    //     user_name: user_name,    //     user_ID: user_id,    //     session_ID: session_id,    //     Login_date: "123",    //     Login_time: "yes",    //     user_IP: ip    // }));}// if(typeof seesion_timeout !== 'undefined'){//////    // sock.onopen = function() {////    // };// }// function logout_function() {//     if(typeof logout_boolen !== 'undefined' ){//         console.log(user_name_logout + "user name logout_boolen");//         console.log("out 2");//         // sock.onopen = function() {//         //     sock.send(JSON.stringify({//         //         user_name: "'.$_SESSION["user_name"].'",//         //         user_ID: "'.$_SESSION["user_id"].'",//         //         session_ID: "'.session_id().'",//         //         Login_date: "123",//         //         Login_time: "yes",//         //         user_IP: "'.file_get_contents("https://api.ipify.org").'"//         //     }));//         ////         // }//         ////////         // sock.onopen = function() {//         //     sock.send(JSON.stringify({//         //         type:"logout",//         //         user_name: user_name_logout,//         //         user_ID:user_id_logout,//         //         session_ID: session_id_logout,//         //         Login_date: "12355",//         //         Login_time: "yes",//         //         user_IP: ip_logout//         //     }));//         ////         // };//         // sock.close();//         // sock.onclose= function clear() {//         //     sock.send(JSON.stringify({//         //         type:"logout",//         //         user_name: user_name_logout,//         //         user_ID:user_id_logout,//         //         session_ID: session_id_logout,//         //         Login_date: "12355",//         //         Login_time: "yes",//         //         user_IP: ip_logout//         //     }));//         //     console.log("closed from client");//         // };////         // window.location.assign("logout.php");////////////     }//// } // if(typeof   user_id_login //     !== "undefined" || typeof  ip_logout !== "undefined"){ //       if(typeof ip_logout !== "undefined") //        { ()=>{ sock.close(); // //        return  ;}} // // // // // // // // // }function forse_logout(user_id_forse_logout) {        sock.send(JSON.stringify({            type:"forse_logout",            user_ID:user_iD        }));    console.log("hi from into ws");};