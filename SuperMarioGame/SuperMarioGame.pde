// --- Game Settings ---
Player player;
ArrayList<Platform> platforms = new ArrayList<Platform>();
float cameraX = 0;
int gameState = 0; // 0: Start, 1: Play, 2: Dead, 3: Win

/**
 * Level Layout:
 * 0 = Empty Space (Gap)
 * 1 = Normal Floor (Brown)
 * 2 = Hazard/Lava (Red with spikes)
 * 3 = Moving Platform (Blue)
 * 4 = Goal (Green with Flag)
 * 5 = High Platform (Brown)
 * 6 = Floating Small (Brown)
 */
int[] levelMap = {
    1, 1, 0, 1, 1, 2, 1, 0, 1, 3, 0, 1, 5, 2, 2, 1, 0, 3, 0, 6, 2, 3, 2, 6, 1,
    0, 1, 5, 2, 2, 2, 1, 1, 1, 0, 1, 2, 3, 2, 1, 5, 6, 5, 2, 3, 2, 3, 2, 1, 1,
    6, 0, 6, 0, 6, 2, 2, 1, 1, 5, 0, 5, 0, 5, 2, 1, 3, 1, 3, 1, 0, 1, 1, 1, 4
};

void setup() {
  size(800, 400);
  resetGame();
}

void resetGame() {
  player = new Player(100, 200);
  platforms.clear();
  cameraX = 0;

  // Build the level based on the map
  for (int i = 0; i < levelMap.length; i++) {
    float x = i * 200;
    if (levelMap[i] == 1) platforms.add(new Platform(x, 350, 180, 50, color(100, 50, 0), false));
    if (levelMap[i] == 2) platforms.add(new Platform(x, 380, 200, 20, color(255, 0, 0), false)); // Hazard
    if (levelMap[i] == 3) platforms.add(new Platform(x, 300, 120, 20, color(0, 0, 255), true));  // Moving
    if (levelMap[i] == 4) platforms.add(new Platform(x, 250, 100, 150, color(0, 255, 0), false)); // Goal
    if (levelMap[i] == 5) platforms.add(new Platform(x, 200, 150, 20, color(100, 50, 0), false)); // High Platform
    if (levelMap[i] == 6) platforms.add(new Platform(x, 150, 50, 20, color(100, 50, 0), false));  // Small Floating
  }
}

void draw() {
  background(20, 20, 40); // Darker, challenging atmosphere

  if (gameState == 1) {
    updateGame();
  } else {
    showScreen();
  }
}

void updateGame() {
  // Smooth Camera
  cameraX = lerp(cameraX, player.pos.x - 200, 0.05);

  pushMatrix();
  translate(-cameraX, 0);

  player.grounded = false; // Reset grounded before checking collisions
  for (Platform p : platforms) {
    p.update();
    p.display();

    // Collision Logic
    if (player.isTouching(p)) {
      if (p.isHazard) {
        gameState = 2; // Dead
      } else if (p.isGoal) {
        gameState = 3; // Win
      } else {
        player.resolveCollision(p);
      }
    }
  }

  player.update();
  player.display();
  popMatrix();

  if (player.pos.y > height) gameState = 2;
}

// --- Player Class ---
class Player {
  PVector pos, vel;
  float size = 30;
  float gravity = 0.8;
  boolean grounded = false;

  Player(float x, float y) {
    pos = new PVector(x, y);
    vel = new PVector(0, 0);
  }

  void update() {
    vel.y += gravity;
    pos.add(vel);

    if (keyPressed) {
      if (keyCode == LEFT) pos.x -= 6;
      if (keyCode == RIGHT) pos.x += 6;
    }
  }

  void display() {
    fill(255, 200, 0);
    rect(pos.x, pos.y, size, size, 5);
  }

  boolean isTouching(Platform p) {
    return pos.x < p.x + p.w && pos.x + size > p.x &&
           pos.y < p.y + p.h && pos.y + size > p.y;
  }

  void resolveCollision(Platform p) {
    // Better collision resolution
    float overlapTop = (pos.y + size) - p.y;
    float overlapBottom = (p.y + p.h) - pos.y;
    float overlapLeft = (pos.x + size) - p.x;
    float overlapRight = (p.x + p.w) - pos.x;

    if (overlapTop < overlapBottom && overlapTop < overlapLeft && overlapTop < overlapRight) {
       if (vel.y > 0) {
         pos.y = p.y - size;
         vel.y = 0;
         grounded = true;
       }
    } else if (overlapBottom < overlapTop && overlapBottom < overlapLeft && overlapBottom < overlapRight) {
       if (vel.y < 0) {
         pos.y = p.y + p.h;
         vel.y = 0;
       }
    }
  }
}

// --- Platform Class ---
class Platform {
  float x, y, w, h, startY;
  color c;
  boolean isMoving, isHazard, isGoal;
  float timer = 0;

  Platform(float x, float y, float w, float h, color c, boolean moving) {
    this.x = x; this.y = y; this.startY = y; this.w = w; this.h = h; this.c = c;
    this.isMoving = moving;
    this.isHazard = (c == color(255, 0, 0));
    this.isGoal = (c == color(0, 255, 0));
    this.timer = random(TWO_PI);
  }

  void update() {
    if (isMoving) {
      timer += 0.05;
      y = startY + sin(timer) * 100; // Vertical movement
    }
  }

  void display() {
    fill(c);
    noStroke();
    rect(x, y, w, h, 4);
    if (isHazard) { // Draw spikes
      fill(255);
      for(int i=0; i<w; i+=10) triangle(x+i, y, x+i+5, y-10, x+i+10, y);
    }
    if (isGoal) {
      fill(255);
      rect(x + w/2 - 5, y - 50, 10, 50);
      fill(255, 255, 0);
      triangle(x + w/2 + 5, y - 50, x + w/2 + 5, y - 30, x + w/2 + 30, y - 40);
    }
  }
}

void keyPressed() {
  if (gameState == 1) {
    if ((key == ' ' || keyCode == UP) && player.grounded) {
      player.vel.y = -15; // High jump for challenge
    }
  } else {
    if (key == ENTER || key == ' ' || keyCode == ENTER) {
      gameState = 1;
      resetGame();
    }
  }
}

void showScreen() {
  textAlign(CENTER);
  fill(255);
  textSize(32);
  if (gameState == 0) text("THE IMPOSSIBLE RUN\n\nUse Arrows to Move\nSPACE to Jump\n\nPress ENTER to Start", width/2, height/2 - 50);
  if (gameState == 2) text("YOU DIED\n\nPress ENTER to Try Again", width/2, height/2 - 20);
  if (gameState == 3) text("VICTORY!\n\nYou conquered the long path.", width/2, height/2 - 20);
}
