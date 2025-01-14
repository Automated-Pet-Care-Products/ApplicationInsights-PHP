# Changelog

## 0.5

- Removed Guzzle
- Added requirement to specify a PSR-7 compliant HTTP client
- Added strict typing
- Fixed millisecond recording

## 0.4.6 (unreleased)

TBD

## 0.4.5

- Fix issue with `trackMetric`
- Allow to gzip telemetry

## 0.4.4

- Initialize `name` and operation id for requests telemetry.
- Updated to the latest schemas. Few properties are no longer available.
- Enum `Dependency_Type` and `async` argument of `TrackDependency` were removed.
- New event type `Availability_Data`.
- Use `Cloud` context instead of `Device` context to set role name and role
  instance of an application.

## 0.4.3

- Support tracking Throwable and Error, not only Exceptions.
- Support for internal context and override of SDK version.
- Fix duration serialization for `trackPageView` call.
- Do not send `User-Agent` when uploading telemetry to avoid misclassification
  of server telemetry as client telemetry.

## 0.4.2

- Changelog started after this version.
