import processing.core.*;
import java.util.ArrayList;

public class SuperMarioGame extends PApplet {
    float playerX, playerY;
    float playerVY = 0;
    float playerSize = 30;
    boolean left, right, up;
    float gravity = 0.6f;
    float jumpStrength = -12;
    float moveSpeed = 5;
    boolean onGround = false;

    float scrollX = 0;
    int gameState = 0; // 0: Start, 1: Playing, 2: Win, 3: Game Over

    ArrayList<Platform> platforms;
    ArrayList<Enemy> enemies;
    Goal goal;

    public void settings() {
        size(800, 600);
    }

    public void setup() {
        initGame();
    }

    void initGame() {
        playerX = 100;
        playerY = 500;
        playerVY = 0;
        scrollX = 0;
        gameState = 0;

        platforms = new ArrayList<Platform>();
        enemies = new ArrayList<Enemy>();

        // Create a long challenging level
        // Ground
        platforms.add(new Platform(0, 550, 800, 50));
        platforms.add(new Platform(900, 550, 600, 50));
        platforms.add(new Platform(1600, 550, 400, 50));
        platforms.add(new Platform(2100, 550, 1000, 50));

        // Obstacles and platforms
        platforms.add(new Platform(300, 450, 100, 20));
        platforms.add(new Platform(450, 350, 100, 20));
        platforms.add(new Platform(600, 250, 100, 20));

        platforms.add(new Platform(1000, 450, 150, 20));
        platforms.add(new Platform(1200, 350, 150, 20));
        platforms.add(new Platform(1400, 250, 150, 20));

        // High platforms
        platforms.add(new Platform(1700, 150, 200, 20));

        // Challenging jumps
        platforms.add(new Platform(2200, 450, 50, 20));
        platforms.add(new Platform(2400, 350, 50, 20));
        platforms.add(new Platform(2600, 250, 50, 20));
        platforms.add(new Platform(2800, 150, 50, 20));

        // Enemies
        enemies.add(new Enemy(400, 520, 300, 500));
        enemies.add(new Enemy(1100, 520, 950, 1300));
        enemies.add(new Enemy(1800, 120, 1700, 1900));
        enemies.add(new Enemy(2300, 520, 2150, 3000));

        goal = new Goal(3000, 550);
    }

    public void draw() {
        background(135, 206, 235); // Sky blue

        if (gameState == 0) {
            drawStartScreen();
        } else if (gameState == 1) {
            updateGame();
            drawGame();
        } else if (gameState == 2) {
            drawWinScreen();
        } else if (gameState == 3) {
            drawGameOverScreen();
        }
    }

    void drawStartScreen() {
        fill(0);
        textAlign(CENTER);
        textSize(40);
        text("SUPER MARIO CLONE", width/2, height/2 - 50);
        textSize(20);
        text("Use Arrow Keys to Move and Jump", width/2, height/2);
        text("Press ENTER to Start", width/2, height/2 + 50);
    }

    void drawWinScreen() {
        fill(0, 150, 0);
        textAlign(CENTER);
        textSize(40);
        text("YOU WIN!", width/2, height/2 - 50);
        fill(0);
        textSize(20);
        text("Press ENTER to Restart", width/2, height/2 + 50);
    }

    void drawGameOverScreen() {
        fill(200, 0, 0);
        textAlign(CENTER);
        textSize(40);
        text("GAME OVER", width/2, height/2 - 50);
        fill(0);
        textSize(20);
        text("Press ENTER to Restart", width/2, height/2 + 50);
    }

    void updateGame() {
        // Movement
        if (left) playerX -= moveSpeed;
        if (right) playerX += moveSpeed;

        // Gravity and Jump
        playerVY += gravity;
        playerY += playerVY;

        onGround = false;
        for (Platform p : platforms) {
            if (playerX + playerSize/2 > p.x && playerX - playerSize/2 < p.x + p.w) {
                if (playerY + playerSize/2 > p.y && playerY + playerSize/2 < p.y + p.h && playerVY > 0) {
                    playerY = p.y - playerSize/2;
                    playerVY = 0;
                    onGround = true;
                }
            }
        }

        if (up && onGround) {
            playerVY = jumpStrength;
        }

        // Camera scroll
        scrollX = lerp(scrollX, playerX - width/4, 0.1f);
        scrollX = max(0, scrollX);

        // Boundaries and Fall
        if (playerY > height) {
            gameState = 3;
        }

        // Enemies update
        for (Enemy e : enemies) {
            e.update();
            if (dist(playerX, playerY, e.x, e.y) < playerSize) {
                gameState = 3;
            }
        }

        // Goal check
        if (dist(playerX, playerY, goal.x, goal.y - 50) < 50) {
            gameState = 2;
        }
    }

    void drawGame() {
        pushMatrix();
        translate(-scrollX, 0);

        // Draw Goal
        goal.display();

        // Draw Platforms
        fill(100, 50, 0);
        for (Platform p : platforms) {
            rect(p.x, p.y, p.w, p.h);
        }

        // Draw Enemies
        fill(255, 0, 0);
        for (Enemy e : enemies) {
            e.display();
        }

        // Draw Player
        fill(255, 255, 0);
        rectMode(CENTER);
        rect(playerX, playerY, playerSize, playerSize);
        rectMode(CORNER);

        popMatrix();
    }

    public void keyPressed() {
        if (keyCode == LEFT) left = true;
        if (keyCode == RIGHT) right = true;
        if (keyCode == UP) up = true;

        if (key == ENTER) {
            if (gameState == 0) gameState = 1;
            else if (gameState == 2 || gameState == 3) {
                initGame();
                gameState = 1;
            }
        }
    }

    public void keyReleased() {
        if (keyCode == LEFT) left = false;
        if (keyCode == RIGHT) right = false;
        if (keyCode == UP) up = false;
    }

    class Platform {
        float x, y, w, h;
        Platform(float x, float y, float w, float h) {
            this.x = x;
            this.y = y;
            this.w = w;
            this.h = h;
        }
    }

    class Enemy {
        float x, y, minX, maxX;
        float speed = 2;
        Enemy(float x, float y, float minX, float maxX) {
            this.x = x;
            this.y = y;
            this.minX = minX;
            this.maxX = maxX;
        }
        void update() {
            x += speed;
            if (x > maxX || x < minX) speed *= -1;
        }
        void display() {
            ellipse(x, y, 30, 30);
        }
    }

    class Goal {
        float x, y;
        Goal(float x, float y) {
            this.x = x;
            this.y = y;
        }
        void display() {
            fill(0, 255, 0);
            rect(x, y - 100, 10, 100);
            ellipse(x + 5, y - 100, 20, 20);
        }
    }

    public static void main(String[] args) {
        PApplet.main("SuperMarioGame");
    }
}
