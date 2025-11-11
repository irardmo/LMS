
import sys
from playwright.sync_api import sync_playwright, expect

def verify_schedule_data(page):
    """
    Navigates to the college secretary dashboard and verifies that the
    schedule table is populated with at least one row of data.
    """
    print("Navigating to the college secretary dashboard...")
    page.goto("http://localhost:8000/college_secretary/dashboard.php", wait_until="load")

    print("Waiting for the schedule table to be visible...")
    schedule_table_body = page.locator("#schedule-table tbody")
    expect(schedule_table_body).to_be_visible(timeout=10000)

    print("Verifying that the schedule table has at least one row...")
    # This assertion will fail if the table is empty, which is the current expected behavior
    expect(schedule_table_body.locator("tr")).to_have_count(1, timeout=10000)

    print("Verification successful: Schedule table is populated.")

def run_verification(playwright):
    browser = playwright.chromium.launch()
    page = browser.new_page()

    # Capture and print console messages
    page.on("console", lambda msg: print(f"Browser console message: {msg.text}"))

    try:
        verify_schedule_data(page)
    except Exception as e:
        print(f"Verification failed: {e}", file=sys.stderr)
        # Taking a screenshot on failure to help debug
        page.screenshot(path="error_screenshot.png")
        print("Screenshot saved to error_screenshot.png", file=sys.stderr)
        sys.exit(1)
    finally:
        browser.close()

if __name__ == "__main__":
    with sync_playwright() as playwright:
        run_verification(playwright)
