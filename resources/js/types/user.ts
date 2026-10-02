import { EducationSphere } from "./educationSphere";
import { EducationLevel } from "./educationLevel";
import { ActivityType } from "./activityType";
import { UserCharacteristic } from "./characteristic";

export interface User {
    id: number;
    first_name: string;
    last_name: string;
    middle_name: string | null;
    full_name: string;
    login: string;
    email: string;
    panel_access: boolean;
    desired_salary: number | null;
    education_levels: EducationLevel[];
    education_spheres: EducationSphere[];
    activity_types: ActivityType[];
    characteristics: UserCharacteristic[];
}