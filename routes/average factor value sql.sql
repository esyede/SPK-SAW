SELECT id, criteria_name,
    (
        SELECT SUM(performance_assessments.convertion_value)
        FROM performance_assessments
            INNER JOIN sub_criterias ON sub_criterias.subcriteria_code=performance_assessments.subcriteria_code
        WHERE performance_assessments.user_id = 1
            AND sub_criterias.factor = 'core'
            AND sub_criterias.criteria_id=criterias.id
    ) AS `core_value`,
    (
        SELECT COUNT(performance_assessments.subcriteria_code)
        FROM performance_assessments
            INNER JOIN sub_criterias ON sub_criterias.subcriteria_code=performance_assessments.subcriteria_code
        WHERE performance_assessments.user_id = 1
            AND sub_criterias.factor = 'core'
            AND sub_criterias.criteria_id=criterias.id
    ) AS `total_core_value`,
    (
        SELECT SUM(performance_assessments.convertion_value)
        FROM performance_assessments
            INNER JOIN sub_criterias ON sub_criterias.subcriteria_code=performance_assessments.subcriteria_code
        WHERE performance_assessments.user_id = 1
            AND sub_criterias.factor = 'secondary'
            AND sub_criterias.criteria_id=criterias.id
    ) AS `secondary_value`,
    (
        SELECT COUNT(performance_assessments.subcriteria_code)
        FROM performance_assessments
            INNER JOIN sub_criterias ON sub_criterias.subcriteria_code=performance_assessments.subcriteria_code
        WHERE performance_assessments.user_id = 1
            AND sub_criterias.factor = 'secondary'
            AND sub_criterias.criteria_id=criterias.id
    ) AS `total_secondary_value`,
    (
        SELECT SUM(performance_assessments.convertion_value)
        FROM performance_assessments
            INNER JOIN sub_criterias ON sub_criterias.subcriteria_code=performance_assessments.subcriteria_code
        WHERE performance_assessments.user_id = 1
            AND sub_criterias.criteria_id=criterias.id
    ) AS `total_value`
FROM criterias;
