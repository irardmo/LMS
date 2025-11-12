# Scheduling Module (scaffold)

Summary
This embedded module provides appointment scheduling for your LMS with:
- FullCalendar-based UI
- REST API endpoints for appointments
- Overlap checks and basic business rules (lead time, duration)
- Audit logging table
- Role-based access (admin, academic_dean, college_secretary)

How to install (XAMPP / local dev)
1. Copy the modules/scheduling/ folder into your LMS repository root (or use the branch that contains it).
2. Edit modules/scheduling/config.php to match your XAMPP MySQL database (DB name, user, password).
   - Default values: host=127.0.0.1, user=root, password='', DB name 'lms_system'.
3. Run the migrations SQL files in phpMyAdmin or the mysql CLI:
   - modules/scheduling/migrations/20251111_create_appointments_table.sql
   - modules/scheduling/migrations/20251111_create_appointments_audit.sql
4. Ensure your LMS session is available to scheduling pages (the module expects $_SESSION['user_id'] and/or $_SESSION['roles']).
   - If your LMS uses different keys or needs an include to initialize session, edit modules/scheduling/auth_check.php accordingly.
5. Visit /modules/scheduling/index.php in your webserver. You should see the calendar.
6. Add links to LMS navigation for roles as needed (e.g., only show "Scheduling" to college_secretary and academic_dean).

Role mapping
- Default role strings used in code: 'admin', 'academic_dean', 'college_secretary'.
- If your LMS uses other strings, update modules/scheduling/auth_check.php and modules/scheduling/api/appointments.php to match.

Next steps
- I can wire email notifications, add CSRF protections, and create UI modals for event CRUD in the next iteration.
