/**
 * @author      PoulycrocStudio <poulycroc.studio@gmail.com>
 */

/**
 * Check if element is null or undefined
 * @param {*} any - String to convert
 * @return {Boolean}
 */
export const isNil = any => {
  return any === undefined || any === null;
};

/**
 * Check if element is an object
 * @param {*} any - String to convert
 * @return {Boolean}
 */
export const isObj = any => {
  if (isNil(any)) return;
  return typeof any === "object";
};

/**
 * Select only element from model object
 * @param {Object} model - ex: { fname:null, lname:null }
 * @param {Object} object - ex: { fname:"xyz", lname:"abc", age:23 }
 * @return {Object} - ex: { fname:"xyz", lname:"abc" }
 */
export const objPick = (model, object) => {
  const res = {};
  Object.keys(model).forEach(key => (res[key] = object[key]));
  return res;
};

/**
 * generate a random string
 * @param {Number} length - length of random string
 * @return {String}
 */
export const makeKey = length => {
  const n = length === undefined ? 6 : length;
  let result = "";
  const chr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  const chrLength = chr.length;
  for (let i = 0; i < n; i++) {
    result += chr.charAt(Math.floor(Math.random() * chrLength));
  }
  return result;
};

/**
 * Convert CamelCaseString to kebab-case-string
 * @param {String} str - String to convert
 * @return {String}
 */
export const toKebabCase = str => {
  if (isNil(str)) return;
  return str
    .replace(/([a-z])([A-Z])/g, "$1-$2")
    .replace(/\s+/g, "-")
    .toLowerCase();
};
