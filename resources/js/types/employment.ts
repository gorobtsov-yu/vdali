import { EducationLevel } from "./educationLevel";
import { EducationSphere } from "./educationSphere";
import { Characteristic } from "./characteristic";
import { Vacancy } from "./vacancy";

export interface IndexEmployment {
  id: number;
  name: string;
  code: string;
  description: string;
  salary_from: number;
  salary_to: number;
  metrics: {
    characteristics_match_metric: number;
    desired_salary_metric: number;
    count: number;
    total: number;
  };
  is_favorite: boolean;
  viewed_at: string;
}

export interface Employment {
  id: number;
  name: string;
  code: string;
  description: string;
  salary_from: number;
  salary_to: number;
  metrics: {
    characteristics_match_metric: number;
    desired_salary_metric: number;
    count: number;
    total: number;
  };
  education_levels: EducationLevel[];
  education_spheres: EducationSphere[];
  characteristics: Characteristic[];
  vacancies: Vacancy[];
  is_favorite: boolean;
  viewed_at: string;
}

