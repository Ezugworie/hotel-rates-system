export var hotelObj = {
  name: '',
  stars: '',
  address: '',
}

export var rateObj = {
  start_date: '',
  end_date: '',
  adult_rate: '',
  child_rate: '',
  hotel_id: '',
}

export var rateSearchObj = {
  check_in_date: '',
  check_out_date: '',
  number_of_adults: '',
  number_of_children: '',
  hotel_id: '',
}

export var searchResultObj = {
  per_adult_rate: '',
  per_child_rate: '',
  total_adults_rate: '',
  total_children_rate: '',
  total_rate: '',
}

export const formatMoney = (value) => `$${chunkReverse(String(value), 3, '')}`

export const chunkReverse = (str, size = 4, separator = '-') => {
  let start = str.length % size
  const parts = [str.substring(0, start)]

  while (start < str.length) {
    const part = str.substring(start, start + size)
    parts.push(part)
    start += size
  }

  return parts.filter(val => !!val).join(separator)
}

export const chunk = (str, size = 4, separator = '-') => {
  let index = 0
  const parts = []

  while (index < str.length) {
    const part = str.substring(index, index + size)
    parts.push(part)
    index += size
  }

  return parts.join(separator)
}