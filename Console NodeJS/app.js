// NodeJS lib requests
const readline = require('readline');

// User created js file requests
const cr = require('./create.js');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

var start = () => {
  // load in json file if exists
    // consisting of previous events
    // consisting of player pool

  // Create a new event
    _create();


  // Add player pool
    // request name for each player
    // add each name to player pool
      // seeding option

  // Generate bracket
    // input players into the bracket in order entered
      // randomise players into bracket
        // seed players into bracket

  // Update bracket
    // update individual game score
    // move winning player to the next round
    // declare next round

  // Conclude bracket
    // declare winner
};

var sep = () => {
  console.log('----------');
}

var _create = () => {

  var eventName;
  var noPlayers;

  console.log('Creating new event...');
  sep();
  // Name of event
  rl.question('Type the name of your event: ', (eventName) => {
    // TODO: Log the answer in a json file
    console.log(`Your event is now called: ${eventName}`);
    sep();
    // How many players
    rl.question('How many players do you have: ', (noPlayers) => {
      // TODO: Log the answer in a json file
      console.log(`You have choosen a ${noPlayers} player event`);
      rl.close();
      cr.createEvent(eventName, noPlayers);
    });
  });
  // Determine bracket size

};





start();
