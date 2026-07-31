# Publishing Guide

This document explains how to release a new version of the **aspose/aspose-html-cloud-php** SDK and publish it to [Packagist](https://packagist.org/packages/aspose/aspose-html-cloud-php).

---

## Package Information

| Field | Value |
|-------|-------|
| **Packagist package** | `aspose/aspose-html-cloud-php` |
| **Packagist URL** | https://packagist.org/packages/aspose/aspose-html-cloud-php |
| **GitHub repository** | https://github.com/aspose-html-cloud/aspose-html-cloud-php |
| **Maintainer account** | [asposehtml](https://packagist.org/users/asposehtml/) |
| **Version scheme** | `<YY>.<M>.<patch>` (e.g. `26.7.1` for July 2026, patch 1) |

> There is also a legacy Packagist alias `aspose/html-sdk-php` maintained by the same account. Both are backed by this repository.

---

## Prerequisites

Before starting a release you need:

1. **Write access** to the [aspose-html-cloud/aspose-html-cloud-php](https://github.com/aspose-html-cloud/aspose-html-cloud-php) GitHub repository.
2. **Packagist credentials** for the `asposehtml` account (see internal credentials vault).
3. **TOTP authenticator** (Google Authenticator, Authy, 1Password, etc.) configured with the Packagist 2FA key for `asposehtml`.
4. **Git** and **PHP 7.4+** installed locally.
5. Optional: **Composer** for validating `composer.json`.

---

## Versioning Rules

The SDK uses a **calendar-based versioning** scheme: `YY.M.patch`.

- `YY` — two-digit year (e.g. `26` for 2026)
- `M` — month number **without leading zero** (e.g. `7` for July, `12` for December)
- `patch` — patch number within the month, starting at `1`

Examples: `25.12.1`, `26.7.1`, `26.7.2`.

Git tags are always prefixed with `v`, e.g. `v26.7.1`.

---

## Release Checklist

### 1. Update the Version Number

The version string appears in **21 files**:

- `composer.json` — the `"version"` field
- All PHP files under `lib/` — the `@version   GIT: @X.Y.Z@` PHPDoc tag

Files that must be updated:

```
composer.json
lib/ApiException.php
lib/Configuration.php
lib/HeaderSelector.php
lib/ObjectSerializer.php
lib/Api/FileApi.php
lib/Api/FolderApi.php
lib/Api/HtmlApi.php
lib/Api/StorageApi.php
lib/Model/DiscUsage.php
lib/Model/Error.php
lib/Model/ErrorDetails.php
lib/Model/FilesList.php
lib/Model/FilesUploadResult.php
lib/Model/FileVersion.php
lib/Model/FileVersions.php
lib/Model/ModelInterface.php
lib/Model/ObjectExist.php
lib/Model/OperationResult.php
lib/Model/StorageExist.php
lib/Model/StorageFile.php
```

You can bump the version quickly with PowerShell (replace `OLD` and `NEW`):

```powershell
$old = "25.12.1"
$new = "26.7.1"

# Update composer.json
(Get-Content composer.json) -replace [regex]::Escape($old), $new | Set-Content composer.json

# Update all PHP source files
Get-ChildItem -Path lib -Recurse -Filter *.php |
    ForEach-Object {
        (Get-Content $_.FullName) -replace [regex]::Escape($old), $new | Set-Content $_.FullName
    }
```

Verify that no old references remain:

```powershell
Select-String -Path composer.json,lib\**\*.php -Pattern $old
```

The command should return **no results**.

### 2. Validate the Package

Make sure PHP files have no syntax errors and `composer.json` is valid:

```powershell
# Syntax-check every PHP source file
Get-ChildItem -Path lib -Recurse -Filter *.php |
    ForEach-Object { php -l $_.FullName } |
    Select-String -Pattern "^(Parse|Errors)"

# Validate composer manifest (if composer is installed)
composer validate --no-check-publish
```

Optionally run the test suite (requires configured Aspose Cloud credentials):

```powershell
vendor\bin\phpunit
```

### 3. Update the CHANGELOG / Documentation

If applicable, update:

- `README.md` — new features, supported formats, examples
- `docs/` — API reference and options
- Any release notes or changelog files

### 4. Commit the Changes

```powershell
git status
git add .
git commit -m "Release version 26.7.1 - <short summary of changes>"
```

### 5. Create the Version Tag

Tags are **annotated** and prefixed with `v`:

```powershell
git tag -a v26.7.1 -m "Version 26.7.1 - <short summary>"
```

Verify the tag:

```powershell
git tag -l v26.7.1
```

### 6. Push to GitHub

Push the commit and the tag separately:

```powershell
git push origin master
git push origin v26.7.1
```

> **Note:** The repository has branch-protection rules that normally require pull requests. Admins can bypass them for release commits; if you do not have bypass rights, open a PR first, merge it, and then create the tag on the merge commit.

If you need to **replace an already-pushed tag** (e.g. after a fixup):

```powershell
git tag -d v26.7.1
git tag -a v26.7.1 -m "Version 26.7.1 - <short summary>"
git push origin v26.7.1 --force
```

### 7. Publish on Packagist

Packagist mirrors GitHub tags automatically once the package is registered, but the sync must be triggered.

1. Open https://packagist.org/packages/aspose/aspose-html-cloud-php.
2. Sign in as **asposehtml** (credentials in the internal vault).
3. Complete 2FA using the TOTP authenticator.
4. Click the **Update** button on the package page.
5. Wait ~30 seconds and refresh — the new `v26.7.1` version should appear at the top of the version list.

> Consider configuring the **GitHub Service Hook** (or the Packagist API token in a GitHub webhook) so future tag pushes are auto-detected without a manual **Update** click.

### 8. Post-release Verification

Confirm the release is installable:

```powershell
# In a scratch folder
composer require aspose/aspose-html-cloud-php:26.7.1
```

Then check:

- The version in `vendor/aspose/aspose-html-cloud-php/composer.json` matches.
- Autoload works (`Client\Invoker\Api\HtmlApi` can be instantiated).

---

## Troubleshooting

| Problem | Solution |
|---------|----------|
| Packagist does not show the new tag | Click **Update** again on the package page; ensure the tag was pushed to GitHub (`git ls-remote --tags origin`). |
| `composer require` cannot find the version | Wait a minute for Packagist mirror to propagate, then run `composer clear-cache` and retry. |
| 2FA code rejected | Ensure device clock is in sync (TOTP is time-based). Re-add the account using the shared TOTP key if needed. |
| Push rejected by branch protection | Open a pull request, merge, then create/push the tag on the resulting commit. |
| Wrong package name pushed | Fix `"name"` in `composer.json`, re-commit, delete and re-push the tag, then click **Update** on Packagist. |

---

## Quick Reference

```powershell
# One-shot release from a clean master branch
$ver = "26.7.1"
git add .
git commit -m "Release version $ver"
git tag -a "v$ver" -m "Version $ver"
git push origin master
git push origin "v$ver"
# then click "Update" at https://packagist.org/packages/aspose/aspose-html-cloud-php
```
