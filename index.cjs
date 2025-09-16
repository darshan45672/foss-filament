const { execSync } = require("child_process");

// Your actual file
const filename = "index.cjs";

// Dates from 14th Sept to 20th Sept 2025
const commitDates = [
  "2025-09-14T11:00:00",
  "2025-09-15T11:00:00",
  "2025-09-16T11:00:00",
  "2025-09-17T11:00:00",
  "2025-09-18T11:00:00",
  "2025-09-19T11:00:00",
  "2025-09-20T11:00:00",
];

commitDates.forEach((commitDate) => {
  // Append something unique to file
  execSync(`echo "Commit on ${commitDate}" >> ${filename}`);

  // Stage the file
  execSync(`git add ${filename}`, { stdio: "inherit" });

  // Commit message
  const commitCommand = `git commit -m "Commit on ${commitDate}"`;

  // Env variables for commit date
  const env = {
    ...process.env,
    GIT_AUTHOR_DATE: commitDate,
    GIT_COMMITTER_DATE: commitDate,
  };

  // Commit
  execSync(commitCommand, { stdio: "inherit", env });

  console.log("✅ Commit created with date:", commitDate);
});

// Push all commits
execSync(`git push`, { stdio: "inherit" });

console.log("🚀 All commits pushed!");"Commit on 2025-09-14T11:00:00" 
"Commit on 2025-09-15T11:00:00" 
"Commit on 2025-09-16T11:00:00" 
