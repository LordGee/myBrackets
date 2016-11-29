const fs = require('fs');
const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

var loadEvent = () => {
  try {
    var loadedEvent = fs.readFileSync('eventData.json');
    return JSON.parse(noteString);
  } catch (e) {
    return [];
  }
}
var saveEvent = (ev) => {
  fs.writeFileSync('eventData.json', JSON.stringify(ev));
}

var createEvent = (_en, _np) => {
  var bracketSize;
  if (_np > 0 && _np <= 2) {
      bracketSize = 2;
  } else if (_np > 2 && _np <= 4) {
      bracketSize = 4;
  } else if (_np > 4 && _np <= 8) {
      bracketSize = 8;
  } else if (_np > 8 && _np <= 16) {
      bracketSize = 16;
  } else if (_np > 16 && _np <= 32) {
      bracketSize = 32;
  } else if (_np > 32 && _np <= 64) {
      bracketSize = 64;
  } else {
      bracketSize = 0;
  }
  if (bracketSize === 0) {
    console.log(`Not enough or too many players, you selected ${_np} players`);
    return;
  } else {
    console.log(`Success you have created a ${bracketSize} player bracket`);
  }
  var data = {
    name: _en,
    players: _np,
    size: bracketSize
  };
  saveEvent(data);
  playerEntry(_np);
};

var playerEntry = (_np) => {
  var players = [_np];
  for (var i = 0; i < _np.length; i++) {
    rl.question(`Enter player ${i + 1}`, (player) => {
      // TODO: Log the answer in a json file
      players[i] = player;
      console.log(`You entered: ${player}`);
      sep();
    });
  }
  rl.close();
}

module.exports = {
  createEvent
};
