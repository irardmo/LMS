# The Impossible Run (Super Mario Clone)

A long and challenging platformer built with Java and the Processing library.

## Features
- **Long Level**: Over 70 segments of varied terrain and obstacles.
- **Challenging Hazards**: Lava pits with spikes, narrow gaps, and moving platforms.
- **Physics-based Movement**: Responsive controls with gravity and jump mechanics.
- **Dynamic Camera**: Smooth camera following the player through the expansive level.
- **Game States**: Start screen, death/retry system, and a victory condition.

## Controls
- **Left/Right Arrow Keys**: Move
- **Space Bar or Up Arrow**: Jump (High jump enabled for difficult gaps)
- **Enter or Space**: Start Game / Restart after death

## Level Design System
The game uses a `levelMap` array for easy level editing:
- `0`: Gap
- `1`: Solid Floor
- `2`: Hazard (Lava/Spikes)
- `3`: Vertical Moving Platform
- `4`: Goal (Flag)
- `5`: High Platform
- `6`: Small Floating Platform

## How to Run

### Option 1: Using Processing IDE
1. Download and install [Processing](https://processing.org/download/).
2. Open the `SuperMarioGame.pde` file.
3. Click the **Run** button.

### Option 2: Using Java and Command Line
Requires the Processing `core.jar` file.
```bash
javac -cp "path/to/core.jar" SuperMarioGame.java
java -cp ".:path/to/core.jar" SuperMarioGame
```
