// (function() {
//     var db = {
//         loadData: function(filter) {
//             return $.grep(this.clients, function(client) {
//                 return (!filter.Name || client.Name.indexOf(filter.Name) > -1)
//                     && (filter.ID === undefined || client.ID === filter.ID)
//                     && (!filter.Address || client.Address.indexOf(filter.Address) > -1)
//                     && (!filter.Position || client.Position === filter.Position)
//                     && (filter.Email === undefined || client.Email === filter.Email);
//             });
//         },

//         insertItem: function(insertingClient) {
//             this.clients.push(insertingClient);
//         },

//         updateItem: function(updatingClient) { },

//         deleteItem: function(deletingClient) {
//             var clientIndex = $.inArray(deletingClient, this.clients);
//             this.clients.splice(clientIndex, 1);
//         }

//     };

//     window.db = db;

//     db.clients = [
//         {
//             "Name": "Carter Clarke",
//             "ID": 59,
//             "Position": 6,
//             "Address": "Ap #547-2921 A Street",
//             "Email": "kabala@gmail.com"
//         }
//     ];

//     db.users = [
//         {
//             "ID": "x",
//             "Account": "A758A693-0302-03D1-AE53-EEFE22855556",
//             "Name": "Carson Kelley",
//             "RegisterDate": "2002-04-20T22:55:52-07:00"
//         },
//         {
//             "Account": "D89FF524-1233-0CE7-C9E1-56EFF017A321",
//             "Name": "Prescott Griffin",
//             "RegisterDate": "2011-02-22T05:59:55-08:00"
//         }
//      ];

// }());