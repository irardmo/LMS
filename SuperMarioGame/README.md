# Super Mario Clone in Processing

This is a simple Super Mario clone written in Java using the Processing library.

## Features
- Player physics (gravity, jumping, movement)
- Parallax-style scrolling camera
- Multiple platform types
- Enemies with basic AI
- Win and Game Over conditions
- A long, challenging level design

## How to Run

### Option 1: Using Processing IDE
1. Download and install [Processing](https://processing.org/download/).
2. Open the `SuperMarioGame.pde` file in Processing.
3. Click the **Run** button.

### Option 2: Using Java and Command Line
If you have the Processing `core.jar` file, you can compile and run it:
```bash
javac -cp "path/to/core.jar" SuperMarioGame.java
java -cp ".:path/to/core.jar" SuperMarioGame
```

## Controls
- **Left/Right Arrow Keys**: Move
- **Up Arrow Key**: Jump
- **Enter**: Start Game / Restart
